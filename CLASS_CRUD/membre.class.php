<?php
// CRUD MEMBRE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MEMBRE
{
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

	function get_AllMembres()
	{
		global $db;
		$query = $db->query('SELECT * FROM membre');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMembresByPseudo($pseudoMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM membre WHERE pseudoMemb=:pseudoMemb");
		$query->execute([
			'pseudoMemb' => $pseudoMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMembresByEmail($eMailMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM membre WHERE eMailMemb=:eMailMemb");
		$query->execute([
			'eMailMemb' => $eMailMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

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

	// Ctrl FK sur LIKECOM, LIKEART avec del
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
