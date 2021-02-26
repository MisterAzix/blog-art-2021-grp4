<?php
// CRUD STATUT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class STATUT
{	
	/**
	 * get_1Statut Permet de récupérer un statut en base de donnée
	 *
	 * @param  string $idStat
	 * @return object Renvoie un object contenant les informations du statut
	 */
	function get_1Statut(string $idStat): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM statut WHERE idStat=:idStat");
		$query->execute([
			'idStat' => $idStat
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllStatuts Permet de récupérer tous les statuts en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les statuts
	 */
	function get_AllStatuts(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM statut');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * create Permet l'ajout d'un statut en base de donnée
	 *
	 * @param  string $libStat
	 * @return void
	 */
	function create(string $libStat)
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
	
	/**
	 * update Permet la modification d'un statut de la base de donnée
	 *
	 * @param  string $idStat
	 * @param  string $libStat
	 * @return void
	 */
	function update(string $idStat, string $libStat)
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
	
	/**
	 * delete Permet la suppression d'un statut de la base de donnée
	 *
	 * @param  string $idStat
	 * @return void
	 */
	function delete(string $idStat)
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
