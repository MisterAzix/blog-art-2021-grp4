<?php
// CRUD STATUT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class STATUT
{
	function get_1Statut($idStat)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM statut WHERE idStat=:idStat");
		$query->execute([
			'idStat' => $idStat
		]);
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
			$query = $db->prepare('INSERT INTO statut (libStat) VALUES (:libStat)');
			$query->execute([
				'libStat' => $libStat
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert STATUT : ' . $e->getMessage());
		}
	}

	function update($idStat, $libStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE statut SET libStat=:libStat WHERE idStat=:idStat');
			$query->execute([
				'idStat' => $idStat,
				'libStat' => $libStat
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}

	function delete($idStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM statut WHERE idStat=:idStat');
			$query->execute([
				'idStat' => $idStat
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete STATUT : ' . $e->getMessage());
		}
	}
}	// End of class
