<?php
// CRUD ARTICLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ARTICLE
{
	function get_1Article($numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM article WHERE numArt=:numArt");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllArticles()
	{
		global $db;
		$query = $db->query('SELECT * FROM article');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllArticlesByAngl($numAngl)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM article WHERE numAngl = :numAngl');
		$query->execute([
			'numAngl' => $numAngl
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function get_AllArticlesByThem($numThem)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM article WHERE numThem = :numThem');
		$query->execute([
			'numThem' => $numThem
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
			$query = $db->prepare('INSERT INTO article (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)');
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
			die('Erreur insert ARTICLE : ' . $e->getMessage());
		}
	}

	function update($numAngl, $libAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE article SET libAngl = :libAngl WHERE numAngl = :numAngl');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update ARTICLE : ' . $e->getMessage());
		}
	}

	function delete($numAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM article WHERE numAngl=:numAngl');
			$query->execute([
				'numAngl' => $numAngl
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete ARTICLE : ' . $e->getMessage());
		}
	}*/
}	// End of class
