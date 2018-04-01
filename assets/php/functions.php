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
	class Admin extends Utils
	{	
		public function check_login($username, $password)
		{
			$username = mysqli_real_escape_string($this->db, $username);
			$password = sha1($password);
			$sql="SELECT id, admin FROM users WHERE username='$username' AND password='$password'";
			
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
				$sql="UPDATE users SET ip='$ip', laston='".date('Y-m-d H:i:s', time())."' WHERE id='$id'";
				mysqli_query($this->db, $sql);
				
				return 1;
			}
			else return 0;
		}
		public function get_session()
		{
			return isset($_SESSION['allergyhelp_admin_login']);
		}
		public function logout() 
		{
			$_SESSION['allergyhelp_admin_login'] = FALSE;
			session_destroy();
		}
	}
	class User extends Utils
	{
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
		public function get_avatar($id)
		{
			if(file_exists("../assets/img/avatars/".$id.".jpg")) $avatar = $id;
			else $avatar = 0;
			$source = "../assets/img/avatars/" . $avatar . ".jpg?=" . filemtime('../assets/img/avatars/'.$avatar.'.jpg');
			return $source;
		}
	}
?>