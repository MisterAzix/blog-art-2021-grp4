<?php
// CRUD MOTCLEARTICLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLEARTICLE
{
	function get_1MotCleArt($numMemb, $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM motclearticle WHERE numMemb=:numMemb AND numArt=:numArt");
		$query->execute([
			'numMemb' => $numMemb,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMotCleArt()
	{
		global $db;
		$query = $db->query('SELECT * FROM motclearticle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMotCleArtByArticle($numArt)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM motclearticle WHERE numArt = :numArt');
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function create($numArt, $numMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO motclearticle (numArt, numMotCle) VALUES (:numArt, :numMotCle)');
			$query->execute([
				'numArt' => $numArt,
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert MOTCLEARTICLE : ' . $e->getMessage());
		}
	}

	function delete($numArt, $numMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM motclearticle WHERE numArt = :numArt AND numMotCle = :numMotCle');
			$query->execute([
				'numArt' => $numArt,
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete MOTCLEARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
