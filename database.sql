SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `action` varchar(128) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `allergies` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `frequent` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `allergies` (`id`, `name`, `content`, `date`, `author`, `frequent`) VALUES
(7, 'Alergie la praf', '<p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Astazi, alergia este o problema recunoscuta, de proportii pandemice, afectand mai mult de 150 milioane de persoane numai in Europa. Tinand cont de tendinta evolutiva actuala, Academia Europeana de Alergie si Imunologie Clinica (EAACI) estimeaza ca in 15 ani mai mult de jumatate din populatia europeana va suferi de cel putin un tip de alergie.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\"><strong style=\"font-weight: bold;\">Persoanele predispuse a deveni alergice, mai precis atopice, sintetizeaza un anume tip de anticorpi, (imunoglobulinele E), ca raspuns la o gama mai restransa sau mai larga de alergene din mediu. O parte din aceste alergene se afla in suspensie in aerul atmosferic, la care popular ne referim ca fiind „praf”. Astfel, termenul de alergie la praf s-a incetatenit si se foloseste pe scara larga.</strong></p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">Trebuie precizat insa ca,&nbsp;<strong style=\"font-weight: bold;\">in general, nu particule vizibile din praf produc reactiile alergice</strong>si ca, evident,&nbsp;<strong style=\"font-weight: bold;\">compozitia prafului din diverse medii e diferita</strong>.</p>', '2018-04-19 20:03:05', 2, 1),
(3, 'Urticarie – alergie la un aliment', '<p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; padding: 0px; font-family: Georgia, sans-serif; color: rgb(71, 71, 71); font-size: 14px;\">Urticaria se manifesta prin umflaturi mici si rosii care te mananca sau te ustura, ca atunci cand te intepi cu&nbsp;<a href=\"http://www.curademiere.ro/10-afectiuni-tratate-cu-urzici/\" style=\"margin: 0px; padding: 0px; color: rgb(4, 95, 159);\"><strong style=\"margin: 0px; padding: 0px;\">urzici</strong></a>. Cand apare din senin si dispare dupa un anumit timp, poate fi vorba despre o alergie la un aliment, la un medicament sau la latex.</p><div style=\"margin: 10px 0px; padding: 0px; color: rgb(9, 9, 9); font-family: Georgia, &quot;Times New Roman&quot;, Times, serif; font-size: 14px; float: none; text-align: center;\"></div><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; padding: 0px; font-family: Georgia, sans-serif; color: rgb(71, 71, 71); font-size: 14px;\">Alimentele care te predispun la alergii sunt fructele exotice, nucile, telina si fructele de mare. Mai rar, la adulti apar alergii la lapte si la oua.</p><div style=\"margin: 10px 0px; padding: 0px; color: rgb(9, 9, 9); font-family: Georgia, &quot;Times New Roman&quot;, Times, serif; font-size: 14px; float: none; text-align: center;\"></div><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; padding: 0px; font-family: Georgia, sans-serif; color: rgb(71, 71, 71); font-size: 14px;\">Medicamentele care au drept reactie adversa alergiile sunt anti-inflamtoarele nesteroidiene (ibuprofen), aspirina si antibioticele din pamilia pencilinelor.</p><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; padding: 0px; font-family: Georgia, sans-serif; color: rgb(71, 71, 71); font-size: 14px;\">Daca nu ai consumat alimente sau medicamente cu potential alergen, poate fi vorba si despre o alergie la un produs care contine latex. Se recomanda renuntarea imediata la contactul cu acel produs.</p><p style=\"margin-right: 0px; margin-bottom: 16px; margin-left: 0px; padding: 0px; font-family: Georgia, sans-serif; color: rgb(71, 71, 71); font-size: 14px;\">Daca urticaria este insotita si de umflarea fetei, mai ales in jurul gurii, sau de o umflatura pronuntata a pielii, trebuie sa consulti de urgenta un medic.</p>', '2018-04-19 19:45:56', 4, 0),
(5, 'Conjunctivita – alergie la cosmetice', '<p><span style=\"color: rgb(71, 71, 71); font-family: Georgia, sans-serif; font-size: 14px;\">Senzatia de nisip in ochi, lacrimarea si uneori mancarimea sunt semne ale conjunctivitei alergice, declansate in general de produsele cosmetice. Din cauza faptului ca vasele sanguine se dilata, poate aparea inrosirea ochilor sau umflarea pleoapelor. Conjunctivita alergica apare si din cauza alergiei la polen sau la praf, insa, in general, este declansata de produsele de&nbsp;</span><a href=\"http://www.curademiere.ro/cum-sa-previi-ridurile-cearcanele-si-pungile-de-sub-ochi/\" style=\"margin: 0px; padding: 0px; color: rgb(4, 95, 159); font-family: Georgia, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\"><strong style=\"margin: 0px; padding: 0px;\">machiaj</strong></a><span style=\"color: rgb(71, 71, 71); font-family: Georgia, sans-serif; font-size: 14px;\">&nbsp;pentru ochi. Nu ingnora acest lucru doar pentru a fi frumoasa, iti poate fi afectata corneea.</span><br></p>', '2018-04-19 19:51:40', 4, 0),
(6, 'Astmul', '<p><span style=\"font-family: Tahoma, Verdana, Arial; font-size: 12px; text-align: justify;\">Astmul este o problema de respiratie care rezulta din inflamarea si spasmul cailor de trecere a&nbsp; aerului din plamani (bronhii). Inflamatia produce o ingustare a cailor de trecere a aerului, ceea ce limiteaza fluxul de aer in si din plamani. Astmul este cel mai adesea dar nu totdeauna legat de alergii.&nbsp;</span><br></p>', '2018-04-19 19:58:35', 4, 0),
(8, 'Alergia la ambrozie', '<p><span style=\"font-family: &quot;Open Sans&quot;;\">Ambrozia este o planta salbatica invaziva care s-a extins rapid in ultimii ani, fiind raspandita in toate cartierele Capitalei si in localitatile limitrofe. Aceasta produce un polen intens alergizant, care determina diferite forme de alergii respiratorii, unele cazuri fiind severe. Deoarece numarul pacientilor cu alergii induse de Ambrosia a crescut in ultimii ani in toata tara, iar in unele judete s-au luat deja masuri de prevenire, va rugam sa ne sprijiniti in declansarea unei campanii de combatere a acestei buruieni prin urmatoarele masuri:&nbsp; identificarea cartierelor din Bucuresti unde este multa Ambrosia si aplicarea unor masuri sustinute de eradicare, cu consultarea specialistilor biologi si alergologi, sustinerea adoptarii unor reglementari locale si masuri legislative prin care proprietarii de terenuri neamenajate sa fie obligati sa le curete si sustinerea unor campanii de informare si avertizare a populatiei</span><br></p>', '2018-04-19 20:04:00', 4, 0),
(11, 'Alergie la polen', '<p style=\"box-sizing: border-box; outline: 0px; border: 0px; font-family: &quot;roboto condensed&quot;, sans-serif; font-size: 16px; margin-right: 0px; margin-bottom: 23px; margin-left: 0px; padding: 0px; vertical-align: baseline; line-height: 19.2px; color: rgb(64, 64, 64);\">Alergia la polen a devenit o reală problemă de sănătate publică, atât din cauză că frecvența ei este în continuă creștere, cât și pentru că influențează negativ starea de sănătate și calitatea vieții persoanelor ce suferă de această boală.</p><p style=\"box-sizing: border-box; outline: 0px; border: 0px; font-family: &quot;roboto condensed&quot;, sans-serif; font-size: 16px; margin-right: 0px; margin-bottom: 23px; margin-left: 0px; padding: 0px; vertical-align: baseline; line-height: 19.2px; color: rgb(64, 64, 64);\">Pentru cei afectați de alergia la polen venirea primăverii nu este deloc o bucurie. Sistemul imunitar al acestor persoane declanșează reacții de apărare exagerate împotriva polenului, o substanță inofensivă pentru majoritatea oamenilor. Anticorpii secretați de sistemul imunitar generează o avalanșă de simptome neplăcute la nivelul nasului, gurii și ochilor.</p>', '2018-04-19 20:14:26', 2, 1),
(12, 'Alergii la veninul de insecte', '<p><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">Alergizarea prin înţepătură de insecte nu este frecventă, însă poate fi extrem de gravă, chiar fatală.</span><span id=\"more-465\" style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"></span><br style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">Principalele insecte responsabile sunt albina (Apis melifera) şi viespea (Vespula spp.). Veninurile de albină şi de viespe sunt diferite, fiecare conţinând diferiţi alergeni majori, bine definiţi. Fosfolipaza A2 şi melitina sunt prezente numai în veninul de albină, antigenul 5 numai în veninul de viespe, dar ambele veninuri conţin hialuronidaza.</span><br style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">Pacienţii sunt rar alergici la ambele tipuri de veninuri în acelaşi timp.</span><br style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">În mod&nbsp;</span><span style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; font-weight: 700; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\">normal</span><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">, după inocularea veninului apare eritem, edem şi durere locală, care mai degrabă se datorează unei reacţii toxice locale, nu unei reacţii alergice; această reacţie non-alergică se dezvoltă într-un interval de câteva ore, fără consecinţe şi se menţine 1-2 zile.</span><br style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">La</span><em style=\"margin: 0px; padding: 0px; font-family: Roboto, Arial, serif; color: rgb(35, 31, 32); font-size: 14px; text-align: justify;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">&nbsp;indivizii alergici</span></em><span style=\"color: rgb(35, 31, 32); font-family: Roboto, Arial, serif; font-size: 14px; text-align: justify;\">, după inocularea veninului apare o reacţie mai rapidă şi de intensitate variabilă de la o reacţie uşoară cu eritem şi edem localizat, prurit şi durere intensă, ce apar în câteva minute de la înţepătură, până la reacţii mai severe ce includ edem şi prurit generalizate, urticarie şi angioedem, stare de slăbiciune, transpiraţii, cefalalgie intensă, crampe abdominale şi stări de vomă, senzaţie de constricţie toracică sau senzaţie de sufocare cu edem laringian şi&nbsp;în cazuri extreme, şoc anfilactic cu potenţial letal; aceste manifestări se pot dezvolta în 10 minute de la înţepătură, aşa că intervenţia promptă este esenţială.</span><br></p>', '2018-04-19 20:17:05', 4, 0),
(15, 'Alergiile la animale', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: &quot;Droid Serif&quot;; font-size: 14px; line-height: 28px; color: rgb(17, 17, 17);\"><span style=\"box-sizing: border-box; font-size: medium;\"><span style=\"box-sizing: border-box;\">Animalele de companie din casa iti indulcesc sosirea acasa, dupa o zi obositoare de munca, dar pot crea si unele probleme de sanatate precum alergiile.</span></span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: &quot;Droid Serif&quot;; font-size: 14px; line-height: 28px; color: rgb(17, 17, 17);\"><span style=\"box-sizing: border-box; font-size: medium;\">Daca descoperim ca suntem alergici la iepuri, capre sau cai, nu ne facem mari probleme pentru ca aceste animale stau, rareori, tot timpul in prezenta noastra. Dar ce ne facem cu cainii si cu pisicile?!</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; font-family: &quot;Droid Serif&quot;; font-size: 14px; line-height: 28px; color: rgb(17, 17, 17);\"><span style=\"box-sizing: border-box; font-size: medium;\">Desi multe persoane dau vina pe parul animalului de companie, ca principala cauza alergenica, reactia neplacuta de mancarime sau stranutul este cauzat, de fapt, de o proteina gasita deseori in saliva, urina si matreata animalului. Asadar, nu suntem alergici la parul de pisica sau de caine, ci la proteina care se raspandeste prin casa, spre exemplu, cand animalul lasa par in urma lui.</span></p>', '2018-04-19 20:23:57', 4, 0),
(16, 'Alergie la mucegai', '<p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\"><a href=\"http://www.csid.ro/health/sanatate/mucegaiul-din-casa-slabeste-imunitatea-9446526/\" target=\"_blank\" title=\"Mucegaiul din casă slăbeşte imunitatea\" style=\"text-decoration-line: underline; color: rgb(17, 155, 183);\">Mucegaiurile&nbsp;</a>se dezvoltă în camere umede, vechi şi prost ventilate, în pivniţe în care există multă umezeală, în băi, pe pereţii de exterior umezi şi reci, sub tapet, pe pereţii din spatele dulapurilor, în spatele tablourilor înrămate, sub mochete, în umidificatoare, sisteme de aer condiţionat, ghivecele plantelor, sere şi chiar în frigidere.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">De asemenea, se pot înmulţi pe suprafaţa unor alimente,&nbsp;<a href=\"http://www.csid.ro/diet-sport/dieta-si-nutritie/fructele-beneficii-uimitoare-pentru-sanatatea-ta-10914127/\" target=\"_blank\" title=\"Fructele - beneficii uimitoare pentru sănătatea ta\" style=\"text-decoration-line: underline; color: rgb(17, 155, 183);\">fructe</a>, legume, pâine sau branză. De altfel, enzimele provenite din mucegaiuri sunt adeseori utilizate in industria de prelucrarea a alimentelor.&nbsp;</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; line-height: 22px; color: rgb(72, 72, 70); font-family: Arial, Helvetica, sans-serif; font-size: 14px;\">“În cazul alergiei la mucegaiuri, alergenii reprezentaţi de sporii acestora, după ce pătrund în organism pe diferite cai, fie prin respiraţie, fie prin contactul cu pielea sau, mai rar, prin consumul unor alimente, vor declanşa rapid&nbsp; un răspuns de apărare din partea sistemului imunitar. Sporii de mucegai pot acţiona, atât ca alergeni de interior, cât si de exterior, situaţie în care pot declanşa o simptomatologie alergică cu un&nbsp; profil sezonier, asemănatoare celei declanşate de polenuri’’, precizează&nbsp;<font color=\"#119bb7\"><u>medicul alergolog Adriana Nicolae</u></font></p>', '2018-04-19 20:29:37', 2, 1),
(17, 'Alergie la cauciucul natural (latex)', '<p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 13.2px;\">Latex de cauciuc natural este un tip special de cauciuc care a fost fabricat din seva arborelui de cauciuc.&nbsp;Seva copacului de cauciuc, sau latexul de cauciuc natural, este un lichid alb opac (din latex chimic) conținând o cantitate mare de cauciuc natural care poate fi folosita pentru fabricarea diferitelor produse de consum.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 13.2px;\">Produsele din latex de cauciuc natural nu pot fi identificate vizual.&nbsp;Orice obiect asemănător cauciucului ar putea fi realizat din latex de cauciuc natural, sau ar putea fi făcut dintr-un material sintetic (inclusiv cauciucul sintetic).&nbsp;Chiar și lucrurile care nu sunt elastice pot avea latex din cauciuc natural in ele ca un strat de vopsea.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 13.2px;\">Latexul nu înseamnă neapărat latex de cauciuc natural.&nbsp;Vopsele din latex si siliconul din latex sunt materiale sintetice care nu conțin, de obicei, latex de cauciuc natural.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 13.2px;\">O alergie la latex este o alergie la produsele fabricate din cauciuc natural.&nbsp;Este o alergie la proteinele care provin din arborele de cauciuc și încă prezent în produsele fabricate din cauciuc natural.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 13.2px;\">Produsele fabricate din latex de cauciuc natural conțin, de obicei, o serie de produse chimice.&nbsp;Unii oameni nu sunt alergici la latex din cauciuc natural în sine, ci la produsele chimice găsite în latexul natural si in produsele din latex de cauciuc fabricat. Alergologul va identifica ce materiale va afecteaza.&nbsp;În cazul în care reacționati la substanțe chimice, ar putea fi o alergie la cauciuc și puteti face referire la un dermatolog pentru alte teste.</p>', '2018-04-19 20:34:48', 4, 0),
(18, 'Alergie la medicamente', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 12px;\">Antibioticele, cu prioritate penicilina şi derivaţii săi sau sulfamidele, sunt principalele substanţe care dau alergii medicamentoase. Dar şi antiinflamatoarele nesteroidiene, cum sunt ibuprofenul, aspirina, produsele anestezice, vaccinurile şi produsele iodate folosite la unele examene radiologice, pot fi responsabile. Reacţiile alergice la acestea apar, uneori, din senin, chiar şi în cazurile în care anterior au fost bine tolerate. Cel mai adesea, simptomele sunt: erupţii cutanate după câteva zile de tratament, dar pot culmina cu şoc anafilactic, avertizează specialiştii.</span><br style=\"color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 12px;\"></p>', '2018-04-19 20:44:16', 2, 0),
(19, 'Alergiile la pește', '<p><span style=\"font-family: arial; font-size: 15px;\">Codul, somonul, tonul, anghila dar si alti pesti pot declansa alergii. Aceste tipuri de alergii sunt similare cu cele provocate de moluste, doar ca in acest caz exista sanse mai mari sa apara la maturitate, fiind mai greu de depasit. Desi este destul de severa, alergia la peste este mai usor de evitat decat alte tipuri de alergii.</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Alergenul major responsabil pentru declansarea alergiei este o proteina numita parvalbumina care tine sub control valoarea calciului din carnea alba. Pentru ca parvalbuninele sunt foarte similare la diferite specii de pesti, alergia la peste poate sa apara indiferent de tipul speciei de peste. Atunci cand o persoana sensibila intra in contact sau consuma peste, apare&nbsp;</span><a title=\"Primul ajutor in cazul reactiilor alergice\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Prim-ajutor/primul-ajutor-in-cazul-reactiilor-alergice_1760\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; color: rgb(84, 124, 164); outline: none; background-color: rgb(255, 255, 255);\">reactia alergica</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;si simptomele specifice acesteia.</span></p><p><span style=\"font-family: arial; font-size: 15px;\">Multe dintre persoanele care sunt alergice la peste, ar trebui sa evite toate speciile de peste, indiferent de locul de provenienta al acestora, intrucat alergenii declansatori sunt intalniti la majoritatea speciilor. De asemenea, ar trebui ocolite inclusiv fructele de mare, intrucat in cazul acestora exista sanse mari sa fie contaminate cu alergenii intalniti la peste. Proteinele de peste pot fi prezente inclusiv in aburii eliberati in timpul gatirii pestelui, declansand reactii alergice. De asemenea, aceste proteine fi ascunse in anumite alimente, provocand reactii neasteptate la persoanele alergice (in sosul pentru salata Caesar, surimi, paella, scampi, sosul worcestershire, etc).</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Parvalbuminele sunt intalnite si in organismul broastelor. De aceea, cei care au alergii la peste ar trebui sa nu consume pui de balta. Alte produse care ar trebui evitate sunt sushi, caviar, icre, capsule de ulei de peste, ulei de ficat de cod. Molustele si crustaceele ar putea fi mancate, de obicei, in siguranta, de catre cei care au alergie la peste. Cu toate acestea exista pericol de contaminare incrucisata si in cazul acestora, iar mai ales in cazul persoanelor cu alergii grave, este recomandabil sa fie evitate.</span><span style=\"font-family: arial; font-size: 15px;\"><br></span><br></p>', '2018-04-19 20:48:05', 4, 0),
(20, 'Alergiile solare', '<p><a title=\"Alergiile\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Alergiile/alergiile_842\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">Alergia</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;solara este o afectiune caracterizata de aparitia unor reactii cutanate in urma expunerii la soare. Adesea, alergia solara se manifesta prin eruptii care dau senzatia de mancarime. Alergiile severe pot provoca&nbsp;</span><a title=\"Urticariile\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Alergiile/urticariile_828\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">urticarie</a><span style=\"font-family: arial; font-size: 15px;\">, vezicule dar si alte simptome neplacute.&nbsp;</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"font-weight: bold; margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\">Exista mai multe tipuri de alergii solare, si anume:</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">- eruptia polimorfa la lumina (fotosensibilitate)</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">- eruptia polimorfa ereditara (prurigo actinic)</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">-&nbsp;</span><a title=\"Dermatita\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Dermatita\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">dermatita</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;actinica cronica si urticaria solara.</span></p><p><strong style=\"font-weight: bold; margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\">Eruptia polimorfa la lumina</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Simptomele&nbsp;</span><a title=\"Eruptia polimorfa la lumina\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Boli-de-piele/eruptia-polimorfa-la-lumina_1424\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">eruptiei polimorfe la lumina</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;(fotosensibilitatea) apar de la cateva minute pana la cateva ore de la expunerea la soare. Aceasta afectiune se caracterizeaza prin faptul ca pe pielea inrosita apar umflaturi mici (papule) galbui sau albicioase sau chiar placi inflamate (umflaturi plate) care provoaca prurit. Din cauza vaselor de sange inflamate, pielea va fi rosie si tumefiata. Zona afectata cuprinde pielea de pe brate, gat si fata. Simptomele dispar in cateva zile daca zona afectata va fi protejata de&nbsp;</span><a title=\"Solarul si riscurile expunerii prelungite la lumina solara\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Ingrijirea-pielii/solarul-si-riscurile-expunerii-prelungite-la-lumina-solara_1421\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">lumina solara</a><span style=\"font-family: arial; font-size: 15px;\">. Pentru majoritatea oamenilor acest tip de alergie se manifesta primavara si vara, timpuriu. Este cel mai comun tip de alergie cauzata de soare.</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"font-weight: bold; margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\">Eruptia polimorfa ereditara (prurigo actinic)&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Apare in mod special la copiii si adultii tineri. Simptomele includ leziuni rosii, denivelate insotite de senzatia de mancarime,&nbsp;</span><a title=\"Veziculele - leziuni tegumentare cu continut lichid (basica cu lichid)\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Varicela-si-zona-zoster/veziculele-leziuni-tegumentare-cu-continut-lichid-basica-cu-lichid_1399\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">vezicule</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;care se pot sparge, putandu-se extinde chiar si pe pielea care nu a fost expusa la soare.&nbsp;</span><a title=\"Buzele crapate - cauze si solutii \" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Frumusete-si-intretinere/buzele-crapate-cauze-si-solutii_6692\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">Buzele</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;pot fi, de asemenea, afectate, crapate si uscate, la fel si zona obrajilor, gatului, urechilor, bratelor si mainilor. La unele persoane, prurigo actinic lasa&nbsp;</span><a title=\"Cicatricile\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Procedee-dermatocosmetice/cicatricile_1400\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">cicatrici</a><span style=\"font-family: arial; font-size: 15px;\">. Manifestarile incep din lunile de vara pana toamna, tarziu.&nbsp;</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"font-weight: bold; margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\">Dermatita actinica cronica&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Poate provoca leziuni inflamatorii uscate acoperite de cruste si insotite de mancarime, in zona fetei, scalpului, spatelui si a partilor laterale ale gatului, toracelui superior si a mainilor. In unele cazuri, pot fi afectate palmele si talpile. Pe anumite regiuni, pielea sanatoasa alterneaza cu cea afectata de dermatita actinica. Simptomele bolii sunt similare cu simptomele provocate de contactul direct cu un&nbsp;</span><a title=\"Alergenii din aer\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Alergiile/alergenii-din-aer_849\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">alergen</a><span style=\"font-family: arial; font-size: 15px;\">, cu cele ale&nbsp;</span><a title=\"Dermatita de contact\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Dermatita/dermatita-de-contact_1342\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">dermatitei de contact</a><span style=\"font-family: arial; font-size: 15px;\">, de exemplu.</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"font-weight: bold; margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\">Urticaria solara&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Se manifesta la cateva minute de la&nbsp;</span><a title=\"Expunerea la soare: mit si adevar\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Mituri-Medicale/expunerea-la-soare-mit-si-adevar_7095\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">expunerea la soare</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;prin eruptie urticariana, mancarimi si aparitia de pustule. Acest tip de alergie poate afecta si zonele acoperite de imbracaminte prin care pot patrunde&nbsp;</span><a title=\" razele ultraviolete artificiale sunt cancerigene, potrivit organizatiei mondiale a sanatatii\" class=\"article-autolink\" href=\"http://www.sfatulmedicului.ro/Diverse/razele-ultraviolete-artificiale-sunt-cancerigene-potrivit-organizatiei-m_4836\" style=\"color: rgb(84, 124, 164); background-color: rgb(255, 255, 255); margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; outline: none;\">razele ultraviolete</a><span style=\"font-family: arial; font-size: 15px;\">. Urticaria solara apare mai ales la varstnici. De obicei, simptomele incept sa se amelioreze la o ora dupa incetarea expunerii la soare.</span><span style=\"font-family: arial; font-size: 15px;\"><br></span></p>', '2018-04-19 20:53:32', 4, 0),
(24, 'Alergie la gândaci de bucătărie', '<p>&nbsp;&nbsp;&nbsp;&nbsp;Gândacii de bucătărie nu sunt doar niște dăunatori hidoși, care se târăsc prin podeaua bucătăriei tale in mijlocul nopții.Ei pot fi la fel de bine și niște declanșatori de alergie.<br>&nbsp; &nbsp; Saliva, fecalele și rămășițele lor pot duce la astm si la alergii.Acești alergeni se comporta ca acarieni, agravând simpotmele când aceștia ajung in aer.<br></p>', '2018-04-19 21:15:01', 3, 0),
(23, 'Alergia la antiperspirant si deodorant', '<p><span style=\"font-family: arial; font-size: 15px;\">Oamenii folosesc deodorant pentru a preveni mirosul urat de&nbsp;</span><a href=\"http://www.sfatulmedicului.ro/Transpiratia/transpiratia-si-mirosul-corpului_1396\" class=\"article-autolink\" title=\"Transpiratia si mirosul corpului\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; color: rgb(84, 124, 164); outline: none; background-color: rgb(255, 255, 255);\">transpiratie</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;al corpului lor. De obicei, acesta se aplica in zona axilei, dar si in locurile in care o persoana transpira mai mult. Sudoarea, amestecandu-se cu deodorantul, miroase mult mai placut. Totusi, ce este de facut pentru a schimba mirosul neplacut in cazul alergiei la deodorant sau antiperspirant? Dar cum poate stii o persoana ca este intr-adevar alergica la substantele continute de aceste produse?</span></p><p><span style=\"font-family: arial; font-size: 15px;\">Doar pentru ca o persoana are o&nbsp;</span><a href=\"http://www.sfatulmedicului.ro/Prim-ajutor/primul-ajutor-in-cazul-reactiilor-alergice_1760\" class=\"article-autolink\" title=\"Primul ajutor in cazul reactiilor alergice\" style=\"margin: 0px; padding: 0px; border: 0px; font-size: 15px; font-family: arial; vertical-align: baseline; color: rgb(84, 124, 164); outline: none; background-color: rgb(255, 255, 255);\">reactie alergica</a><span style=\"font-family: arial; font-size: 15px;\">&nbsp;la un anumit tip de deodorant, nu inseamna ca este alergica la toate. Pentru inceput, poate incerca sa schimbe marca. In unele cazuri, reactia manifestata este de fapt cauzata de parfumul din componenta produsului. Unele parfumuri, prea puternice, pot genera chiar si probleme ale sinusurilor.&nbsp;</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"margin: 0px; padding: 0px; font-weight: bold; font-family: arial; font-size: 15px;\">In cazul in care schimbarea marcii nu functioneaza</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">In aceasta situatie se vor explora alte alternative: trebuie sa gasiti optiuni pentru a controla transpiratia si pentru a mirosi bine, in acelasi timp. Una dintre variante ar fi folosirea pudrei pentru bebelus. Pentru ca efectul acesteia nu este de lunga durata, recipientul cu pudra trebuie tinut la indemana.&nbsp;</span><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><strong style=\"margin: 0px; padding: 0px; font-weight: bold; font-family: arial; font-size: 15px;\">Avizul unui expert</strong><br style=\"margin: 0px; padding: 0px; font-family: arial; font-size: 15px;\"><span style=\"font-family: arial; font-size: 15px;\">Daca o persoana nu este sigura daca este sau nu alergica la produsele antiperspirante, pentru confirmarea acestui lucru trebuie sa consulte un medic alergolog. Acesta va face o serie de teste pentru a depista care sunt alergenii care declanseaza simptomele bolii. Alergia la deodorant nu trebuie tratata cu indiferenta, iar instructiunile si tratamentul medicului trebuie urmate cu atentie.</span><span style=\"font-family: arial; font-size: 15px;\"><br></span><br></p>', '2018-04-19 21:01:32', 4, 0),
(25, 'Alergia la ou', '<p><span style=\"color: rgb(119, 119, 119); font-family: HelveticaNeueLTPro-Lt; font-size: 20px;\">Alergia la ou este foarte fecvent întalnită la copii, fiind pe locul doi în topul alergiilor alimentare la vârste mici, după alergia la laptele de vacă si derivați. Aproximativ 2% dintre copii suferă de acest tip de alergie alimentară, dar din fericire, aproximativ 70 % dintre ei se vor vindeca către pubertate de această alergie.</span><br></p>', '2018-04-19 21:38:56', 3, 0),
(26, 'Alergia la soia', '<p><span style=\"box-sizing: border-box; color: rgb(88, 88, 88); font-family: &quot;Roboto Condensed&quot;, sans-serif; background-color: rgb(253, 253, 253);\">Alergia la soia este o reacție exagerată a sistemului imunitar la consumul de soia și alimente care conțin soia. De obicei, reacția se produce ca urmare a consumului de lapte din soia&nbsp;în copilărie.</span><br></p>', '2018-04-19 21:45:38', 3, 0);

CREATE TABLE `allergy_causes` (
  `id` int(11) NOT NULL,
  `allergy` int(11) NOT NULL,
  `cause` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `allergy_causes` (`id`, `allergy`, `cause`) VALUES
(18, 15, 9),
(16, 12, 13),
(3, 3, 4),
(15, 11, 5),
(14, 8, 12),
(13, 7, 11),
(12, 7, 3),
(8, 5, 5),
(9, 5, 10),
(10, 6, 1),
(11, 6, 5),
(19, 16, 8),
(20, 17, 7),
(21, 18, 14),
(22, 19, 4),
(23, 20, 15),
(29, 26, 4),
(28, 25, 4),
(27, 23, 16);

CREATE TABLE `allergy_signs` (
  `id` int(11) NOT NULL,
  `allergy` int(11) NOT NULL,
  `sign` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `allergy_signs` (`id`, `allergy`, `sign`) VALUES
(26, 11, 14),
(25, 11, 11),
(24, 11, 3),
(23, 11, 2),
(22, 8, 17),
(6, 3, 4),
(7, 3, 11),
(21, 8, 16),
(20, 8, 2),
(10, 5, 2),
(11, 5, 11),
(12, 6, 10),
(13, 6, 12),
(14, 6, 16),
(15, 7, 2),
(16, 7, 11),
(17, 7, 17),
(18, 7, 18),
(19, 7, 19),
(27, 11, 16),
(28, 11, 17),
(29, 11, 18),
(30, 12, 9),
(31, 12, 11),
(32, 12, 14),
(33, 12, 15),
(34, 15, 2),
(35, 15, 11),
(36, 15, 17),
(37, 16, 7),
(38, 16, 11),
(39, 16, 12),
(40, 16, 17),
(41, 16, 18),
(42, 16, 20),
(43, 16, 22),
(44, 16, 23),
(45, 17, 2),
(46, 17, 4),
(47, 17, 11),
(48, 18, 4),
(49, 18, 24),
(50, 19, 7),
(51, 19, 8),
(52, 19, 10),
(53, 20, 4),
(54, 20, 5),
(55, 20, 10),
(56, 20, 11),
(57, 20, 15),
(58, 20, 20),
(68, 24, 4),
(67, 24, 3),
(69, 24, 16),
(70, 25, 4),
(71, 25, 7),
(64, 23, 4),
(65, 23, 10),
(66, 23, 11),
(72, 25, 8),
(73, 25, 12),
(74, 25, 16),
(75, 25, 24),
(76, 26, 3),
(77, 26, 4),
(78, 26, 7),
(79, 26, 12),
(80, 26, 22),
(81, 26, 26),
(82, 26, 27),
(83, 26, 28),
(84, 26, 29),
(85, 26, 30);

CREATE TABLE `bot_jokes` (
  `id` int(11) NOT NULL,
  `joke` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `bot_jokes` (`id`, `joke`) VALUES
(1, 'Did you hear about the Frenchman who could only count to seven?<br />He had a huit allergy.'),
(2, 'A man walks into a charity shop looking for a pair of trousers. The label inside declares, ‘May contain traces of nuts’.'),
(3, '- Why did the chicken cross the road?<br />- To avoid his allergen.'),
(4, '- Did you hear about the convict who had allergies?<br />- He broke out.');

CREATE TABLE `bot_messages` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `userid` int(11) NOT NULL,
  `frombot` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `bot_messages` (`id`, `message`, `userid`, `frombot`, `date`) VALUES
(1, 'Bună, Alexandru!<br />Eu sunt AllergyBot, dar poți să-mi spui și Botzică! :)<br />Scrie <strong>ajutor</strong> pentru a afla ce pot să fac!', 1, 1, '2018-05-06 22:07:30'),
(2, 'Bună, Octavian!<br />Eu sunt AllergyBot, dar poți să-mi spui și Botzică! :)<br />Scrie <strong>ajutor</strong> pentru a afla ce pot să fac!', 2, 1, '2018-05-05 11:09:52'),
(3, 'Bună, Claudiu!<br />Eu sunt AllergyBot, dar poți să-mi spui și Botzică! :)<br />Scrie <strong>ajutor</strong> pentru a afla ce pot să fac!', 3, 1, '2018-05-06 21:48:04'),
(4, 'Bună, Parascheva!<br />Eu sunt AllergyBot, dar poți să-mi spui și Botzică! :)<br />Scrie <strong>ajutor</strong> pentru a afla ce pot să fac!', 4, 1, '2018-05-05 11:09:52'),
(5, 'Bună, Comisie!<br />Eu sunt AllergyBot, dar poți să-mi spui și Botzică! :)<br />Scrie <strong>ajutor</strong> pentru a afla ce pot să fac!', 5, 1, '2018-05-05 11:09:52');

CREATE TABLE `causes` (
  `id` int(11) NOT NULL,
  `cause` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `causes` (`id`, `cause`) VALUES
(1, 'Fum de țigară'),
(2, 'Gândaci de bucătărie'),
(3, 'Acarieni'),
(4, 'Alimente'),
(5, 'Polen'),
(6, 'Fân'),
(7, 'Latex'),
(8, 'Mucegai'),
(9, 'Păr de animale'),
(10, 'Cosmetice'),
(11, 'Praf'),
(12, 'Ambrozia'),
(13, 'Înțepături de insecte'),
(14, 'Antibiotice'),
(15, 'Expunerea la soare'),
(16, 'Compoziția chimică');

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `unread` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `userid` int(11) NOT NULL,
  `conversation` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` varchar(256) NOT NULL,
  `link` varchar(32) DEFAULT NULL,
  `date` datetime NOT NULL,
  `dismissed` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `notifications` (`id`, `user`, `title`, `content`, `link`, `date`, `dismissed`) VALUES
(1, 1, 'Bine ai venit pe AllergyHelp!', 'Ți-ai creat contul cu succes. Acum ai acces la tot conținutul site-ului. Pentru a primi notificări cu privire la anumite alergii, îți recomandăm să îți alegi simptomele și cauzele.', '?p=profile', '2018-04-22 23:00:00', 0),
(2, 2, 'Bine ai venit pe AllergyHelp!', 'Ți-ai creat contul cu succes. Acum ai acces la tot conținutul site-ului. Pentru a primi notificări cu privire la anumite alergii, îți recomandăm să îți alegi simptomele și cauzele.', '?p=profile', '2018-04-22 23:00:00', 0),
(3, 3, 'Bine ai venit pe AllergyHelp!', 'Ți-ai creat contul cu succes. Acum ai acces la tot conținutul site-ului. Pentru a primi notificări cu privire la anumite alergii, îți recomandăm să îți alegi simptomele și cauzele.', '?p=profile', '2018-04-22 23:00:00', 0),
(4, 4, 'Bine ai venit pe AllergyHelp!', 'Ți-ai creat contul cu succes. Acum ai acces la tot conținutul site-ului. Pentru a primi notificări cu privire la anumite alergii, îți recomandăm să îți alegi simptomele și cauzele.', '?p=profile', '2018-04-22 23:00:00', 0),
(5, 5, 'Bine ai venit pe AllergyHelp!', 'Ți-ai creat contul cu succes. Acum ai acces la tot conținutul site-ului. Pentru a primi notificări cu privire la anumite alergii, îți recomandăm să îți alegi simptomele și cauzele.', '?p=profile', '2018-04-22 23:00:00', 0);

CREATE TABLE `signs` (
  `id` int(11) NOT NULL,
  `sign` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `signs` (`id`, `sign`) VALUES
(17, 'Strănuturi'),
(2, 'Lăcrimare'),
(3, 'Rinoree (secreție nazală)'),
(4, 'Erupții la nivelul pileii'),
(5, 'Senzație de oboseală'),
(6, 'Convalescență'),
(7, 'Vomă'),
(8, 'Dureri de stomac'),
(9, 'Umflarea unei zone a corpului'),
(10, 'Stări de discomfort'),
(11, 'Mâncărime'),
(12, 'Respirație greoaie'),
(13, 'Dureri în gât'),
(14, 'Furnicături'),
(15, 'Febră'),
(16, 'Tuse'),
(18, 'Înroșirea ochilor'),
(19, 'Inflamarea pleoapelor'),
(20, 'Dureri de cap'),
(21, 'Oboseală'),
(22, 'Urticarie'),
(23, 'Balonare'),
(24, 'Șoc anafilactic'),
(25, 'Prurit '),
(26, 'Respirație șuierătoare'),
(27, 'Crampe'),
(28, 'Diaree'),
(29, 'Anafilaxie'),
(30, 'Stări de leșin');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `regtime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `lastname`, `firstname`, `admin`, `email`, `password`, `regtime`) VALUES
(1, 'Toderică', 'Alexandru', 1, 'a.toderica.2013@gmail.com', '9cc02838891b6d0e41122f672fd3cadacf1074a1', '2018-03-20 10:51:05'),
(2, 'Iacob', 'Octavian', 1, 'octavzz1999@gmail.com', '9cc02838891b6d0e41122f672fd3cadacf1074a1', '2018-04-04 00:45:03'),
(3, 'Scurtu', 'Claudiu', 1, 'scurtu.claudyu@gmail.com', '9cc02838891b6d0e41122f672fd3cadacf1074a1', '2018-04-04 11:51:12'),
(4, 'Negru', 'Parascheva', 1, 'parascheva.negru@gmail.com', '9cc02838891b6d0e41122f672fd3cadacf1074a1', '2018-04-04 12:32:35'),
(5, 'FIICode', 'Comisie', 1, 'fiicode', '9cc02838891b6d0e41122f672fd3cadacf1074a1', '2018-04-04 12:33:49');

CREATE TABLE `user_allergies` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `allergy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `user_causes` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `cause` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `user_signs` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `sign` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `allergy_causes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `allergy_signs`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bot_jokes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bot_messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cause` (`cause`);

ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `signs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sign` (`sign`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

ALTER TABLE `user_allergies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_causes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_signs`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `allergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

ALTER TABLE `allergy_causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE `allergy_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

ALTER TABLE `bot_jokes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `bot_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `user_allergies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
