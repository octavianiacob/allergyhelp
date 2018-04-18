<?php
	include "config.php";
	date_default_timezone_set('Europe/Bucharest');

	class Utils
	{
		public $db;
		public function __construct()
		{
			$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			if(mysqli_connect_errno())
			{
				echo "Nu s-a putut face conexiunea la baza de date!";
				exit;
			}
			mysqli_set_charset($this->db, 'utf8');
		}
		public function get_ip_address()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else
				$ip = $_SERVER['REMOTE_ADDR'];
			return $ip;
		}
		public function mysqli_result($res, $row = 0, $col = 0)
		{
			$numrows = mysqli_num_rows($res);
			if ($numrows && $row <= ($numrows - 1) && $row >= 0)
			{
				mysqli_data_seek($res,$row);
				$resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
				if (isset($resrow[$col]))
					return $resrow[$col];
			}
			return false;
		}
		public function time_passed($timestamp)
		{
			$timestamp      = strtotime($timestamp);
			$current_time   = strtotime(date('Y-m-d H:i:s', time()));
			$diff           = $current_time - $timestamp;

			$intervals      = array (
				'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
			);

			$prepoz = "de";

			if ($diff == 0)
			{
				return 'chiar acum';
			}

			if ($diff < 60)
			{
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum o secundă' : 'acum ' . $diff . ' '. $prepoz .' secunde';
			}

			if ($diff >= 60 && $diff < $intervals['hour'])
			{
				$diff = floor($diff/$intervals['minute']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum un minut' : 'acum ' . $diff . ' '. $prepoz .' minute';
			}

			if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
			{
				$diff = floor($diff/$intervals['hour']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum o oră' : 'acum ' . $diff . ' '. $prepoz .' ore';
			}

			if ($diff >= $intervals['day'] && $diff < $intervals['week'])
			{
				$diff = floor($diff/$intervals['day']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum o zi' : 'acum ' . $diff . ' '. $prepoz .' zile';
			}

			if ($diff >= $intervals['week'] && $diff < $intervals['month'])
			{
				$diff = floor($diff/$intervals['week']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum o săptămână' : 'acum ' . $diff . ' '. $prepoz .' săptămâni';
			}

			if ($diff >= $intervals['month'] && $diff < $intervals['year'])
			{
				$diff = floor($diff/$intervals['month']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum o lună' : 'acum ' . $diff . ' '. $prepoz .' luni';
			}

			if ($diff >= $intervals['year'])
			{
				$diff = floor($diff/$intervals['year']);
				if($diff < 20) $prepoz = "";
				return $diff == 1 ? 'acum un an' : 'acum ' . $diff . ' '. $prepoz .' ani';
			}
		}
	}
	class User extends Utils
	{
		public function check_login($email, $password)
		{
			$email = mysqli_real_escape_string($this->db, $email);
			$password = sha1($password);
			$sql="SELECT id FROM users WHERE email='$email' AND password='$password'";

			$result = mysqli_query($this->db,$sql);
			$user_data = mysqli_fetch_array($result);
			$count_row = $result->num_rows;

			if($count_row == 1)
			{
				$_SESSION['allergyhelp_login'] = true;
				$_SESSION['allergyhelp_id'] = $user_data['id'];
				return 1;
			}
			return 0;
		}
		public function register($email, $pass, $lastname, $fistname)
		{
			$email = mysqli_real_escape_string($this->db, $email);
			$lastname = mysqli_real_escape_string($this->db, $lastname);
			$firstname = mysqli_real_escape_string($this->db, $fistname);

			$pass = sha1($pass);
			$sql = "SELECT * FROM users WHERE email='$email'";

			$check =  $this->db->query($sql);
			$count_row = $check->num_rows;

			if ($count_row == 0)
			{
				$sql = "INSERT INTO users SET email='$email', password='$pass', lastname='$lastname', firstname='$firstname', regtime='".date('Y-m-d H:i:s', time())."'";
				mysqli_query($this->db,$sql);
				return 1;
			}
			return 0;
		}
		public function get_fullname($id)
		{
			$sql = "SELECT firstname, lastname FROM users WHERE id = $id";
			$result = mysqli_query($this->db,$sql);
			$user_data = mysqli_fetch_array($result);
			return $user_data['firstname']." ".$user_data['lastname'];
		}
		public function get_firstname($id)
		{
			return $this->mysqli_result(mysqli_query($this->db, "SELECT firstname FROM users WHERE id = '$id'"));
		}
		public function get_lastname($id)
		{
			return $this->mysqli_result(mysqli_query($this->db, "SELECT lastname FROM users WHERE id = '$id'"));
		}
		public function get_email($id)
		{
			return $this->mysqli_result(mysqli_query($this->db, "SELECT email FROM users WHERE id = '$id'"));
		}
		public function get_avatar($id)
		{
			if(file_exists("assets/img/avatars/".$id.".jpg")) $avatar = $id;
			else $avatar = 0;
			$source = "assets/img/avatars/" . $avatar . ".jpg?=" . filemtime('assets/img/avatars/'.$avatar.'.jpg');
			return $source;
		}
		public function isadmin($id)
		{
			return $this->mysqli_result(mysqli_query($this->db, "SELECT admin FROM users WHERE id = '$id'"));
		}
		public function get_session()
		{
			return isset($_SESSION['allergyhelp_login']);
		}
		public function logout()
		{
			$_SESSION['allergyhelp_login'] = FALSE;
			session_destroy();
		}
	}
	class Admin extends User
	{
		public function check_login($email, $password)
		{
			$email = mysqli_real_escape_string($this->db, $email);
			$password = sha1($password);
			$sql="SELECT id, admin FROM users WHERE email='$email' AND password='$password'";

			$result = mysqli_query($this->db,$sql);
			$user_data = mysqli_fetch_array($result);
			$count_row = $result->num_rows;

			if($count_row == 1)
			{
				if(!$user_data['admin'])
					return -1;
				$_SESSION['allergyhelp_admin_login'] = true;
				$_SESSION['allergyhelp_admin_id'] = $user_data['id'];

				$ip = $this->get_ip_address();
				$id = $user_data['id'];
				$sql="INSERT INTO logins SET userid='$id', ip='$ip', date='".date('Y-m-d H:i:s', time())."'";
				mysqli_query($this->db, $sql);

				return 1;
			}
			else return 0;
		}
		public function get_logins()
		{
			$sql = "SELECT * FROM logins ORDER BY date DESC LIMIT 5";
			$result = mysqli_query($this->db, $sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo '
				<li class="list-group-item">
					<img class="avatar float-left" src="'.$this->get_avatar($row["userid"]).'" />
					<strong>'.$this->get_fullname($row["userid"]).'</strong>
					<br><small class="time text-muted">'.$this->time_passed($row["date"]).'</small>
				</li>
				';
			}
		}
		public function get_actions()
		{
			$sql = "SELECT * FROM actions ORDER BY date DESC LIMIT 5";
			$result = mysqli_query($this->db, $sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo '
				<li class="list-group-item">
					<img class="avatar float-left" src="'.$this->get_avatar($row["userid"]).'" />
					<strong>'.$this->get_fullname($row["userid"]).'</strong> '.$row["action"].'
					<br><small class="time text-muted">'.$this->time_passed($row["date"]).'</small>
				</li>
				';
			}
		}
		public function add_action($adminid, $action)
		{
			$sql="INSERT INTO actions SET userid='$adminid', action='$action', date='".date('Y-m-d H:i:s', time())."'";
			return mysqli_query($this->db, $sql);
		}
		public function add_user($adminid, $email, $pass, $lastname, $fistname)
		{
			$email = mysqli_real_escape_string($this->db, $email);
			$lastname = mysqli_real_escape_string($this->db, $lastname);
			$firstname = mysqli_real_escape_string($this->db, $fistname);

			$pass = sha1($pass);
			$sql = "SELECT * FROM users WHERE email='$email'";

			$check =  $this->db->query($sql);
			$count_row = $check->num_rows;

			if ($count_row == 0)
			{
				$sql = "INSERT INTO users SET email='$email', password='$pass', lastname='$lastname', firstname='$firstname', regtime='".date('Y-m-d H:i:s', time())."'";
				$result = mysqli_query($this->db,$sql);

				if($result) $this->add_action($adminid, "a înregistrat un utilizator");
				return $result;
			}
			else return false;
		}
		public function edit_profile($id, $email, $pass = "", $lastname, $fistname)
		{
			if(!empty($pass))
			{
				$pass = sha1($pass);
				$sql = "UPDATE users SET password='$pass' WHERE id = '$id'";
				$result = mysqli_query($this->db, $sql);
				if($result) $_SESSION['allergyhelp_admin_change_pass_success'] = true;
				else $_SESSION['allergyhelp_admin_change_pass_fail'] = true;
			}
			$email = mysqli_real_escape_string($this->db, $email);
			$lastname = mysqli_real_escape_string($this->db, $lastname);
			$firstname = mysqli_real_escape_string($this->db, $fistname);

			$sql = "UPDATE users SET email='$email', lastname='$lastname', firstname='$firstname' WHERE id = '$id'";
			$result = mysqli_query($this->db,$sql);
			return $result;
		}
		public function get_users()
		{
			$sql = "SELECT * FROM users ORDER BY regtime DESC";
			$result = mysqli_query($this->db, $sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo '
				<tr>
					<td>'.$row["lastname"].' '.$row["firstname"].'</td>
					<td>'.$row["email"].'</td>
					<td>'.$row["regtime"].'</td>
					<td>';
				if($row["admin"]) echo '<a title="Înlătură drepturile de administrator" class="revoke-admin-icon" href="?revokeadmin='.$row["id"].'" /><i class="fas fa-fw fa-star"></i></a>';
				else echo '<a title="Fă-l administrator" class="make-admin-icon" href="?makeadmin='.$row["id"].'" /><i class="far fa-fw fa-star make-admin-icon"></i></a>';
				echo '
					<!--<i class="fa fa-fw fa-edit text-info"></i>
					<i class="fa fa-fw fa-trash text-danger"></i>-->
					</td>
				</tr>';
			}
		}
		public function get_admins()
		{
			$sql = "SELECT * FROM users WHERE admin = 1 ORDER BY regtime ASC";
			$result = mysqli_query($this->db, $sql);
			while($row = mysqli_fetch_assoc($result))
			{
				echo '
				<div class="admin">
					<div class="card box-shadow">
						<div class="card-body p-3">
							<img class="avatar admin-avatar" src="'.$this->get_avatar($row["id"]).'" />
							<span class="admin-name">'.$row["firstname"].' '.$row["lastname"].'</span>
							<small class="text-muted">'.$row["email"].'</small>
						</div>
					</div>
				</div>
				';
			}
		}
		public function add_sign($adminid, $sign)
		{
			$sign = mysqli_real_escape_string($this->db, $sign);
			$sql = "INSERT INTO signs SET sign = '$sign'";
			$result = mysqli_query($this->db, $sql);

			if($result) $this->add_action($adminid, "a adăugat un simptom");
			return $result;
		}
		public function add_cause($adminid, $cause)
		{
			$cause = mysqli_real_escape_string($this->db, $cause);
			$sql = "INSERT INTO causes SET cause = '$cause'";
			$result = mysqli_query($this->db, $sql);

			if($result) $this->add_action($adminid, "a adăugat o cauză");
			return $result;
		}
		public function get_signs()
		{
			$sql = "SELECT * FROM signs ORDER BY sign ASC";
			$result = mysqli_query($this->db, $sql);
			if(mysqli_num_rows($result))
			{
				while($row = mysqli_fetch_assoc($result))
				{
					echo '
					<li class="list-group-item">
						'.$row['sign'].'
						<!--<span class="badge">
							<i class="fas fa-fw fa-pencil-alt text-warning"></i>
							<i class="fa fa-fw fa-trash text-danger"></i>
						</span>-->
					</li>
					';
				}
			}
			else
				echo '
					<li class="list-group-item">
						Nu există niciun simptom adăugat!
					</li>
					';
		}
		public function get_causes()
		{
			$sql = "SELECT * FROM causes ORDER BY cause ASC";
			$result = mysqli_query($this->db, $sql);
			if(mysqli_num_rows($result))
			{
				while($row = mysqli_fetch_assoc($result))
				{
					echo '
					<li class="list-group-item">
						'.$row['cause'].'
						<!--<span class="badge">
							<i class="fas fa-fw fa-pencil-alt text-warning"></i>
							<i class="fa fa-fw fa-trash text-danger"></i>
						</span>-->
					</li>
					';
				}
			}
			else
				echo '
					<li class="list-group-item">
						Nu există nicio cauză adăugată!
					</li>
					';
		}
		public function set_admin($adminid, $userid)
		{
			$sql = "UPDATE users SET admin = 1 WHERE id = '$userid'";
			$result = mysqli_query($this->db, $sql);

			if($result) $this->add_action($adminid, "a adăugat un administrator");
			return $result;
		}
		public function revoke_admin($adminid, $userid)
		{
			$sql = "UPDATE users SET admin = 0 WHERE id = '$userid'";
			$result = mysqli_query($this->db, $sql);

			if($result) $this->add_action($adminid, "a șters un administrator");
			return $result;
		}
		public function count_users()
		{
			return $this->mysqli_result(mysqli_query($this->db, "SELECT COUNT(*) FROM users"));
		}
		public function get_avatar($id)
		{
			if(file_exists("../assets/img/avatars/".$id.".jpg")) $avatar = $id;
			else $avatar = 0;
			$source = "../assets/img/avatars/" . $avatar . ".jpg?=" . filemtime('../assets/img/avatars/'.$avatar.'.jpg');
			return $source;
		}
		public function get_admin_session()
		{
			return isset($_SESSION['allergyhelp_admin_login']);
		}
		public function admin_logout()
		{
			$_SESSION['allergyhelp_admin_login'] = FALSE;
			session_destroy();
		}
	}
?>