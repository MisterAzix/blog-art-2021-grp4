<?php
// CRUD MOTCLEARTICLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLEARTICLE
{
	/**
	 * get_1MotCleArt Permet de récupérer un mot clé d'un article
	 *
	 * @param  string $numArt
	 * @param  string $numMotCle
	 * @return object Renvoie un object avec les informations du mot clé
	 */
	function get_1MotCleArt(string $numArt, string $numMotCle): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM motclearticle WHERE numArt=:numArt AND numMotCle=:numMotCle");
		$query->execute([
			'numArt' => $numArt,
			'numMotCle' => $numMotCle
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllMotCleArt Permet de récupérer tous les mots clés d'article
	 *
	 * @return array Renvoie un tableau d'object avec les informations des mots-clés
	 */
	function get_AllMotCleArt(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM motclearticle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllMotCleArtByArticle Permet de récupérer tous les mots clés d'un article
	 *
	 * @param  string $numArt
	 * @return array Renvoie un tableau d'object avec les informations des mots-clés
	 */
	function get_AllMotCleArtByArticle(string $numArt): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM motclearticle WHERE numArt = :numArt');
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * create Permet d'ajouter l'association d'un mot clé et d'un article en base de donnée
	 *
	 * @param  string $numArt
	 * @param  string $numMotCle
	 * @return void
	 */
	function create(string $numArt, string $numMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT IGNORE INTO motclearticle (numArt, numMotCle) VALUES (:numArt, :numMotCle)');
			$query->execute([
				'numArt' => $numArt,
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert MOTCLEARTICLE : ' . $e->getMessage());
		}
	}

	/**
	 * delete Permet de supprimer l'association d'un mot clé et d'un article en base de donnée
	 *
	 * @param  string $numArt
	 * @param  string $numMotCle
	 * @return void
	 */
	function delete(string $numArt, string $numMotCle)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM motclearticle WHERE numArt=:numArt AND numMotCle=:numMotCle');
			$query->execute([
				'numArt' => $numArt,
				'numMotCle' => $numMotCle
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert MOTCLEARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
