<?php
// CRUD LIKEART (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKEART
{	
	/**
	 * get_1LikeArt Permet de récupérer un seul like d'article en base de donnée
	 *
	 * @param  mixed $numMemb
	 * @param  string $numArt
	 * @return object Renvoie un object comprenant les informations du like d'article récupéré
	 */
	function get_1LikeArt(mixed $numMemb, string $numArt): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM likeart WHERE numMemb=:numMemb AND numArt=:numArt");
		$query->execute([
			'numMemb' => $numMemb,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesArt Permet de récupérer tous les likes d'article en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les like d'article
	 */
	function get_AllLikesArt(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM likeart');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesArtByArticle Permet de récupérer tous les likes d'un article
	 *
	 * @param  string $numArt
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les likes récupérés
	 */
	function get_AllLikesArtByArticle(string $numArt): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likeart WHERE numArt = :numArt');
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllLikesArtByMembre Permet de récupérer tous les likes d'un membre
	 *
	 * @param  mixed $numMemb
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les likes récupérés
	 */
	function get_AllLikesArtByMembre(mixed $numMemb): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM likeart WHERE numMemb = :numMemb');
		$query->execute([
			'numMemb' => $numMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}
	
	/**
	 * createOrUpdate Permet d'ajouter un like d'article en base de donnée ou de modifier son état s'il existe déjà
	 *
	 * @param  mixed $numMemb
	 * @param  string $numArt
	 * @return void
	 */
	function createOrUpdate(mixed $numMemb, string $numArt)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO likeart (numMemb, numArt, likeA) VALUES (:numMemb, :numArt, 1) ON DUPLICATE KEY UPDATE likeA = !likeA');
			$query->execute([
				'numMemb' => $numMemb,
				'numArt' => $numArt
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insertOrUpdate LIKEART : ' . $e->getMessage());
		}
	}
}	// End of class
