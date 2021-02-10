<?php
// CRUD LIKEART (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKEART
{
	function get_1LikeArt($numArt, $numMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM likeart WHERE numArt=:numArt AND numMemb=:numMemb");
		$query->execute([
			'numAngl' => $numArt,
			'numAngl' => $numMemb
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesArt($numArt)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likeart WHERE numArt = :numArt');
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLikesArtByMembre($numMemb)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likeart WHERE numMemb = :numMemb');
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
			$query = $db->prepare('INSERT INTO likeart (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)');
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
			die('Erreur insert LIKEART : ' . $e->getMessage());
		}
	}

	function update($numAngl, $libAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE likeart SET libAngl = :libAngl WHERE numAngl = :numAngl');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update LIKEART : ' . $e->getMessage());
		}
	}

	function delete($numAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM likeart WHERE numAngl=:numAngl');
			$query->execute([
				'numAngl' => $numAngl
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete LIKEART : ' . $e->getMessage());
		}
	}*/
}	// End of class
