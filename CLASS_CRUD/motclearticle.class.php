<?php
// CRUD MOTCLEARTICLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLEARTICLE
{
	function get_1MotCleArt($numArt, $numMotCle)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM motclearticle WHERE numArt=:numArt AND numMotCle=:numMotCle");
		$query->execute([
			'numArt' => $numArt,
			'numMotCle' => $numMotCle
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

	function createOrDelete($numArt, $numMotCle)
	{
		global $db;
		$exist = $this->get_1MotCleArt($numArt, $numMotCle);
		$queryStr = $exist ? 
		'DELETE FROM motclearticle WHERE numArt=:numArt AND numMotCle=:numMotCle' : 
		'INSERT INTO motclearticle (numArt, numMotCle) VALUES (:numArt, :numMotCle)';
		try {
			$db->beginTransaction();
			$query = $db->prepare($queryStr);
			$query->execute([
				'numArt' => $numArt,
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur' . $exist ? 'delete' : 'insert' . 'MOTCLEARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
