<?php
// CRUD THEMATIQUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class THEMATIQUE
{	
	/**
	 * get_1Thematique Permet de récupérer une thématique dans la base de donnée
	 *
	 * @param  string $numThem
	 * @return object Renvoie un object avec les informations de la thématique
	 */
	function get_1Thematique(string $numThem): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM thematique WHERE numThem=:numThem");
		$query->execute([
			'numThem' => $numThem
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllThematiques Permet de récupérer toutes les thématiques
	 *
	 * @return array Renvoie un tableau d'objet contenant les informations des thématiques
	 */
	function get_AllThematiques(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM thematique');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllThematiquesByLang Permet de récupérer toutes les thématiques en fonction d'une langue
	 *
	 * @param  string $numLang
	 * @return array Renvoie un tableau d'objet contenant les informations des thématiques récupérées
	 */
	function get_AllThematiquesByLang(string $numLang): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM thematique WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}
	
	/**
	 * create Permet d'ajouter une thématique à la base de donnée
	 *
	 * @param  string $libThem
	 * @param  string $numLang
	 * @return void
	 */
	function create(string $libThem, string $numLang)
	{
		global $db;
		require_once __DIR__ . './getNextNumThem.php';
		$numThem = getNextNumThem($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO thematique (numThem, libThem, numLang) VALUES (:numThem, :libThem, :numLang)');
			$query->execute([
				'numThem' => $numThem,
				'libThem' => $libThem,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert THEMATIQUE : ' . $e->getMessage());
		}
	}
	
	/**
	 * update Permet de modifier une thématique de la base de donnée
	 *
	 * @param  string $numThem
	 * @param  string $libThem
	 * @return void
	 */
	function update(string $numThem, string $libThem)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE thematique SET libThem = :libThem WHERE numThem = :numThem');
			$query->execute([
				'numThem' => $numThem,
				'libThem' => $libThem
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update THEMATIQUE : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet de supprimer une thématique de la base de donnée
	 *
	 * @param  string $numThem
	 * @return void
	 */
	function delete(string $numThem)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM thematique WHERE numThem=:numThem');
			$query->execute([
				'numThem' => $numThem
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete THEMATIQUE : ' . $e->getMessage());
		}
	}
}	// End of class
