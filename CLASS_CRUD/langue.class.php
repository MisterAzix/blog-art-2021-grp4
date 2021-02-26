<?php
// CRUD LANGUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE
{	
	/**
	 * get_1Langue Permet de récuper une seule langue en base de donnée
	 *
	 * @param  string $numLang
	 * @return object Renvoie un object comprenant les informations de la langue récupérée
	 */
	function get_1Langue(string $numLang): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM langue WHERE numLang=:numLang");
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_1LangueByPays Permet de récupérer une langue en base de donnée en fonction d'un pays
	 *
	 * @param  string $numLang
	 * @param  string $numPays
	 * @return object Renvoie un object comprenant les informations de la langue récupérée
	 */
	function get_1LangueByPays(string $numLang, string $numPays): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM langue WHERE numLang=:numLang AND numPays=:numPays");
		$query->execute([
			'numLang' => $numLang,
			'numPays' => $numPays
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLangues Permet de récupérer toutes les langues en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de toutes les langues
	 */
	function get_AllLangues(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM langue');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLanguesByPays Permet de récupérer toutes les langues en base de donnée en fonction d'un pays
	 *
	 * @param  string $numPays
	 * @return array Renvoie un tableau d'object comprenant les informations de toutes les langues récupérées
	 */
	function get_AllLanguesByPays(string $numPays): array
	{
		global $db;
		$query = $db->prepare("SELECT * FROM langue WHERE numPays=:numPays");
		$query->execute([
			'numPays' => $numPays
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllPays Permet de récupérer tous les pays en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les pays
	 */
	function get_AllPays(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM pays');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * create Permet d'ajouter une nouvelle langue en base de donnée
	 *
	 * @param  string $lib1Lang
	 * @param  string $lib2Lang
	 * @param  string $numPays
	 * @return void
	 */
	function create(string $lib1Lang, string $lib2Lang, string $numPays)
	{
		global $db;
		require_once __DIR__ . '/getNextNumLang.php';
		$numLang = getNextNumLang($numPays);
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO langue (numLang, lib1Lang, lib2Lang, numPays) VALUES (:numLang, :lib1Lang, :lib2Lang, :numPays)');
			$query->execute([
				'numLang' => $numLang,
				'lib1Lang' => $lib1Lang,
				'lib2Lang' => $lib2Lang,
				'numPays' => $numPays
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur create LANGUE : ' . $e->getMessage());
		}
	}
	
	/**
	 * update Permet de modifier une langue dans la base de donnée
	 *
	 * @param  string $numLang
	 * @param  string $lib1Lang
	 * @param  string $lib2Lang
	 * @return void
	 */
	function update(string $numLang, string $lib1Lang, string $lib2Lang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE langue SET lib1Lang=:lib1Lang, lib2Lang=:lib2Lang WHERE numLang=:numLang');
			$query->execute([
				'numLang' => $numLang,
				'lib1Lang' => $lib1Lang,
				'lib2Lang' => $lib2Lang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update LANGUE : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet de supprimer une langue de la base de donnée
	 *
	 * @param  string $numLang
	 * @return void
	 */
	function delete(string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM langue WHERE numLang=:numLang');
			$query->execute([
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete LANGUE : ' . $e->getMessage());
		}
	}
}	// End of class
