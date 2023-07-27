<?php
class Connexion{
     private $_db;
     public function __construct(){
           try{$this->_db = new PDO('mysql:host=localhost;dbname=PROJET', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));}
           catch (Exception $e){die('Erreur : ' . $e->getMessage());}
      }

     public function responseQuery($selecteur, $table,$field, $pseudo)
     {
           $req = 'SELECT '.''.$selecteur.' FROM '.''.$table.' WHERE '.''.$field.' = "'.$pseudo.'"';
           $q = $this->_db->query($req);
           $clients = [];
          while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
          {
              $clients[] = $donnees;
          }
          return $clients;
     } 
     public function responseQueryAll($selecteur, $table)
     {
           $req = 'SELECT '.''.$selecteur.' FROM '.''.$table;
           $q = $this->_db->query($req);
          while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
          {
              $clients[] = $donnees;
          }
          return $clients;
     }     
     public function responseJoin()
     {
           $req = 'SELECT investissement.NomInv,investissement.SomInv,investissement.TypeInv,investissement.DateDebutInv,utilisateur.Solde FROM utilisateur INNER JOIN investissement ON utilisateur.idUtil = investissement.idUtil';
           $q = $this->_db->query($req);
           while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
           {
                $clients[] = $donnees;
           }
         return $clients;
     }
     public function update(array $client)
     {
           $q = $this->_db->prepare('UPDATE INVESTISSEMENT SET DateIncrement = NOW() WHERE IdInv= :id');
           $q->bindValue(':id', $client[1]);
           $q->execute();
           $u = $this->responseQuery("*","INVESTISSEMENT","NomInv", $client[0]);
           $i = 0;
           $gains = 0;
           while( $i < count($u)){
                $gains += (int) $u[$i]["GainInv"];
                $i += 1;
           }
           $upUtil = $this->_db->prepare('UPDATE UTILISATEUR SET Solde = :solde WHERE PseudoUtil= :pseudo');
           $upUtil->bindValue(':solde', $gains);
           $upUtil->bindValue(':pseudo', $client[0]);
           $upUtil->execute();
     }
     public function add(Investissement $client)
     {
          $q = $this->_db->prepare('INSERT INTO INVESTISSEMENT SET NomInv = 
              :pseudo,SomInv = :som, idUtil = :id, typeInv= :inv');
          $q->bindValue(':pseudo', $client->nomInv());
          $q->bindValue(':som', $client->somInv());
          $q->bindValue(':id', $client->idUtil());
          $q->bindValue(':inv', $client->typeInv());
          $q->execute();
     }
     

}

?>