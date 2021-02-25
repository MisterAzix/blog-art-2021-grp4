<?php
// CRUD MEMBRE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MEMBRE
{	
	/**
	 * get_1Membre Permet de récuper un seul membre en base de donnée
	 *
	 * @param  mixed $numMemb 
	 * @return object Renvoie un object comprenant les informations du membre récupéré
	 */
	function get_1Membre($numMemb): object
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
	 */
	function get_1MembreByPseudo($pseudoMemb): object
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
	 * create Permet d'ajouter un nouveau membre en base de donnée
	 *
	 * @param  string $prenomMemb
	 * @param  string $nomMemb
	 * @param  string $pseudoMemb
	 * @param  string $eMailMemb
	 * @param  string $passMemb
	 * @param  mixed $idStat
	 * @return void
	 */
	function create($prenomMemb, $nomMemb, $pseudoMemb, $eMailMemb, $passMemb, $idStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO membre (prenomMemb, nomMemb, pseudoMemb, eMailMemb, passMemb, dtCreaMemb, souvenirMemb, accordMemb, idStat) VALUES (:prenomMemb, :nomMemb, :pseudoMemb, :eMailMemb, :passMemb, NOW(), 0, 0, :idStat)');
			$query->execute([
				'prenomMemb' => $prenomMemb,
				'nomMemb' => $nomMemb,
				'pseudoMemb' => $pseudoMemb,
				'eMailMemb' => $eMailMemb,
				'passMemb' => $passMemb,
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
	 * @param  mixed $numMemb
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
