<?php
// CRUD LIKECOM (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKECOM
{
	function get_1LikeCom($numArt, $numMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM likecom WHERE numArt=:numArt AND numMemb=:numMemb");
		$query->execute([
			'numAngl' => $numArt,
			'numAngl' => $numMemb
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesCom($numArt)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likecom WHERE numArt = :numArt');
		$query->execute([
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

	/*function create($libAngl, $numLang)
	{
		global $db;
		require_once __DIR__ . '/getNextNumAngl.php';
		$numAngl = getNextNumAngl($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO likecom (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert LIKECOM : ' . $e->getMessage());
		}
	}

	function update($numAngl, $libAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE likecom SET libAngl = :libAngl WHERE numAngl = :numAngl');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update LIKECOM : ' . $e->getMessage());
		}
	}

	function delete($numAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM likecom WHERE numAngl=:numAngl');
			$query->execute([
				'numAngl' => $numAngl
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete LIKECOM : ' . $e->getMessage());
		}
	}*/
}	// End of class
