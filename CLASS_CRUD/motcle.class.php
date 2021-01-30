<?php
// CRUD MOTCLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLE
{
	function get_1MotCle($numMotCle)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM motcle WHERE numMotCle=:numMotCle");
		$query->execute([
			'numMotCle' => $numMotCle
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMotsCles()
	{
		global $db;
		$query = $db->query('SELECT * FROM motcle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllMotClesByLang($numLang)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM motcle WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function create($libMotCle, $numLang)
	{
		global $db;
		require_once __DIR__ . './getNextNumLang.php';
		$numMotCle = getNextNumMoCle($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO motcle (numMotCle, libMotCle, numLang) VALUES (:numMotCle, :libMotCle, :numLang)');
			$query->execute([
				'numMotCle' => $numMotCle,
				'libMotCle' => $libMotCle,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert MOTCLE : ' . $e->getMessage());
		}
	}

	function update($numMotCle, $libMotCle, $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE motcle SET libMotCle = :libMotCle, numLang = :numLang WHERE numMotCle = :numMotCle');
			$query->execute([
				'numMotCle' => $numMotCle,
				'libMotCle' => $libMotCle,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update MOTCLE : ' . $e->getMessage());
		}
	}

	function delete($numMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM motcle WHERE numMotCle=:numMotCle');
			$query->execute([
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete MOTCLE : ' . $e->getMessage());
		}
	}
}	// End of class
