<?php
// CRUD STATUT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class STATUT
{
	function get_1Statut($idStat)
	{
		global $db;
		$query = $db->query("SELECT * FROM statut WHERE idStat=$idStat");
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllStatuts()
	{
		global $db;
		$query = $db->query('SELECT * FROM statut');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function create($libStat)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}

	function update($idStat, $libStat)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}

	function delete($idStat)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}
}	// End of class
