<?php
// CRUD LIKECOM (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKECOM
{
	function get_1LikeCom($numMemb, $numSeqCom, $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM likecom WHERE numMemb=:numMemb AND numSeqCom=:numSeqCom AND numArt=:numArt");
		$query->execute([
			'numMemb' => $numMemb,
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesCom()
	{
		global $db;
		$query = $db->query('SELECT * FROM likecom');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesComByComment($numSeqCom, $numArt)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numSeqCom = :numSeqCom AND numArt = :numArt');
		$query->execute([
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesComByMembre($numMemb)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numMemb = :numMemb');
		$query->execute([
			'numMemb' => $numMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function createOrUpdate($numMemb, $numSeqCom, $numArt)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO likecom (numMemb, numSeqCom, numArt, likeC) VALUES (:numMemb, :numSeqCom, :numArt, 1) ON DUPLICATE KEY UPDATE likeC = !likeC');
			$query->execute([
				'numMemb' => $numMemb,
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insertOrUpdate LIKECOM : ' . $e->getMessage());
		}
	}
}	// End of class
