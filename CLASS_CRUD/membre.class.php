<?php
// CRUD MEMBRE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MEMBRE
{	
	/**
	 * get_1Membre Permet de récuper un seul membre en base de donnée
	 *
	 * @param  string $numMemb 
	 * @return object Renvoie un object comprenant les informations du membre récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1Membre($numMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM membre WHERE numMemb=:numMemb");
		$query->execute([
			'numMemb' => $numMemb
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllMembres Permet de récupérer tous les utilisateurs en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant des informations de tous les membres
	 */
	function get_AllMembres(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM membre');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllMembresByPseudo Permet de récupérer un membre en base de donnée en fonction de son pseudo
	 *
	 * @param  string $pseudoMemb
	 * @return object Renvoie un object comprenant les informations du membre récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1MembreByPseudo($pseudoMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM membre WHERE pseudoMemb=:pseudoMemb");
		$query->execute([
			'pseudoMemb' => $pseudoMemb
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllMembresByPseudo Permet de récupérer un membre en base de donnée en fonction de son email
	 *
	 * @param  string $eMailMemb
	 * @return object Renvoie un object comprenant les informations du membre récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1MembreByEmail($eMailMemb)
	{
		global $db;
		$query = $db->prepare("SELECT numMemb, passMemb FROM membre WHERE eMailMemb=:eMailMemb");
		$query->execute([
			'eMailMemb' => $eMailMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_1MembreByEmailOrUsername ermet de récupérer un membre en base de donnée en fonction de son email ou son pseudo
	 *
	 * @param  mixed $emailOrUsername
	 * @return object Renvoie un object comprenant les informations du membre récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1MembreByEmailOrUsername($emailOrUsername)
	{
		global $db;
		$query = $db->prepare("SELECT numMemb, passMemb FROM membre WHERE eMailMemb = :eMailMemb OR pseudoMemb = :pseudoMemb");
		$query->execute([
			'eMailMemb' => $emailOrUsername,
			'pseudoMemb' => $emailOrUsername
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllMembresByStatut Permet de récupérer tous les membres en base de donnée en fonction d'un statut
	 *
	 * @param  mixed $idStat
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les membres récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllMembresByStatut($idStat)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM membre WHERE idStat=:idStat");
		$query->execute([
			'idStat' => $idStat
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * create Permet d'ajouter un nouveau membre en base de donnée
	 *
	 * @param  string $prenomMemb
	 * @param  string $nomMemb
	 * @param  string $pseudoMemb
	 * @param  string $eMailMemb
	 * @param  string $passMemb
	 * @param  string $idStat
	 * @param  string $cgu
	 * @param  string $newsletter
	 * @return void
	 */
	function create($prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb, $idStat = 1, $cgu = false, $newsletter = false)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO membre (prenomMemb, nomMemb, pseudoMemb, eMailMemb, passMemb, dtCreaMemb, souvenirMemb, accordMemb, idStat) VALUES (:prenomMemb, :nomMemb, :pseudoMemb, :eMailMemb, :passMemb, NOW(), 0, :accordMemb, :idStat)');
			$query->execute([
				'prenomMemb' => $prenomMemb,
				'nomMemb' => $nomMemb,
				'pseudoMemb' => $pseudoMemb,
				'eMailMemb' => $eMailMemb,
				'passMemb' => $passMemb,
				'accordMemb' => $cgu,
				'idStat' => $idStat
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur create MEMBRE : ' . $e->getMessage());
		}
	}
	
	/**
	 * update Permet de modifier un membre dans la base de donnée
	 *
	 * @param  string $numMemb
	 * @param  string $prenomMemb
	 * @param  string $nomMemb
	 * @param  string $pseudoMemb
	 * @param  string $eMailMemb
	 * @param  string $passMemb
	 * @return void
	 */
	function update($numMemb, $prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE membre SET prenomMemb=:prenomMemb, nomMemb=:nomMemb, pseudoMemb=:pseudoMemb, eMailMemb=:eMailMemb, passMemb=:passMemb WHERE numMemb=:numMemb');
			$query->execute([
				'numMemb' => $numMemb,
				'prenomMemb' => $prenomMemb,
				'nomMemb' => $nomMemb,
				'pseudoMemb' => $pseudoMemb,
				'eMailMemb' => $eMailMemb,
				'passMemb' => $passMemb
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update MEMBRE : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet de supprimer un membre de la base de donnée
	 *
	 * @param  string $numMemb
	 * @return void
	 */
	function delete($numMemb)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM membre WHERE numMemb=:numMemb');
			$query->execute([
				'numMemb' => $numMemb
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete MEMBRE : ' . $e->getMessage());
		}
	}
}	// End of class
