<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ANGLE
{
	function get_1Angle($numAngl)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM angle WHERE numAngl=:numAngl");
		$query->execute([
			'numAngl' => $numAngl
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllAngles()
	{
		global $db;
		$query = $db->query('SELECT * FROM angle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllAnglesByLang($numLang)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM angle WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function create($numAngl, $libAngl, $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO angle (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)');
			$query->execute([
				'numMotCle' => $numAngl,
				'libMotCle' => $libAngl,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert ANGLE : ' . $e->getMessage());
		}
	}

	function update($numAngl, $libAngl, $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE angle SET libMotCle = :libMotCle, numLang = :numLang WHERE numMotCle = :numMotCle');
			$query->execute([
				'numMotCle' => $numAngl,
				'libMotCle' => $libAngl,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update ANGLE : ' . $e->getMessage());
		}
	}

	function delete($numAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM angle WHERE numAngl=:numAngl');
			$query->execute([
				'numAngl' => $numAngl
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete ANGLE : ' . $e->getMessage());
		}
	}
}	// End of class
