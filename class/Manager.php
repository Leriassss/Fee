<?php
class Manager
{
     protected $_db;
     public function __construct($db){
         $this->setDb($db);
     }	 
        public function add(Users $client)
        {
             $q = $this->_db->prepare('INSERT INTO UTILISATEUR SET PseudoUtil = 
                 :pseudo,MailUtil = :mail, TelUtil = :tel, PassUtil= :passw');
             $q->bindValue(':pseudo', $client->pseudo());
             $q->bindValue(':mail', $client->email());
             $q->bindValue(':tel', $client->tel());
             $q->bindValue(':passw', $client->password());
             $q->execute();
        }
        public function delete(Users $client)
        {
             $this->_db->exec('DELETE FROM UTILISATEUR WHERE PseudoUtil = '.$client->pseudo());
        }
        public function getLine($mail)
        {
             $req = 'SELECT * FROM UTILISATEUR WHERE MailUtil = '.'"'.$mail.'"';
           $q = $this->_db->query($req);
           $donnees = $q->fetch(PDO::FETCH_ASSOC);
           return $donnees;
        }
        public function getList()
        {
             $clients = array();
             $q = $this->_db->query('SELECT * FROM UTILISATEUR ORDER BY PseudoUtil');
             while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
             {
                 $clients[] = $donnees;
             }
             return $clients;
        }
        public function update(Users $client)
        {
             $q = $this->_db->prepare('UPDATE UTILISATEUR SET PseudoUtil = 
             :pseudo,MailUtil = :mail, TelUtil = :tel, PassUtil= :passw');
         $q->bindValue(':pseudo', $client->pseudo());
         $q->bindValue(':mail', $client->email());
         $q->bindValue(':tel', $client->tel());
         $q->bindValue(':passw', $client->password());
         $q->execute();
        }
        public function setDb(PDO $db)
        {
             $this->_db = $db;
        }
        public function responseQuery($selecteur, $table,$field, $pseudo)
        {
              $req = 'SELECT '.''.$selecteur.' FROM '.''.$table.' WHERE '.''.$field.' = "'.$pseudo.'"';
              echo $req;
              $q = $this->_db->query($req);
             while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
             {
                 $clients[] = $donnees;
             }
             return $clients;
        }    
}
?>