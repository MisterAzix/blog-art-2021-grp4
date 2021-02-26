<?php
// CRUD MOTCLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLE
{	
	/**
	 * get_1MotCle Permet de récupérer un mot clé
	 *
	 * @param  mixed $numMotCle
	 * @return object Renvoie un object contenant les information du mot clé récupéré
	 */
	function get_1MotCle(mixed $numMotCle): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM motcle WHERE numMotCle=:numMotCle");
		$query->execute([
			'numMotCle' => $numMotCle
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllMotsCles Permet de récupérer tous les mots clés
	 *
	 * @return array Renvoie un tableau d'object contenant les informations des mots clés
	 */
	function get_AllMotsCles(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM motcle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllMotClesByLang Permet de récupérer tous les mots clés d'une langue
	 *
	 * @param  string $numLang
	 * @return array Renvoie un tableau d'object contenant les informations des mots clés
	 */
	function get_AllMotClesByLang(string $numLang): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM motcle WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}
	
	/**
	 * create Permet d'ajouter un mot clé à la base de donnée
	 *
	 * @param  string $libMotCle
	 * @param  string $numLang
	 * @return void
	 */
	function create(string $libMotCle, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO motcle (libMotCle, numLang) VALUES (:libMotCle, :numLang)');
			$query->execute([
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
	
	/**
	 * update Permet de modifier un mot clé en base de donnée
	 *
	 * @param  mixed $numMotCle
	 * @param  string $libMotCle
	 * @return void
	 */
	function update(mixed $numMotCle, string $libMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE motcle SET libMotCle = :libMotCle WHERE numMotCle = :numMotCle');
			$query->execute([
				'numMotCle' => $numMotCle,
				'libMotCle' => $libMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update MOTCLE : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet de supprimer un mot clé de la base de donnée
	 *
	 * @param  mixed $numMotCle
	 * @return void
	 */
	function delete(mixed $numMotCle)
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
