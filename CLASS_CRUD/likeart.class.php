<?php
// CRUD LIKEART (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKEART
{	
	/**
	 * get_1LikeArt Permet de récupérer un seul like d'article en base de donnée
	 *
	 * @param  string $numMemb
	 * @param  string $numArt
	 * @return object Renvoie un object comprenant les informations du like d'article récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1LikeArt(string $numMemb, string $numArt)
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
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllLikesArtByArticle(string $numArt)
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
	 * @param  string $numMemb
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les likes récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllLikesArtByMembre(string $numMemb)
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
	 * @param  string $numMemb
	 * @param  string $numArt
	 * @return void
	 */
	function createOrUpdate(string $numMemb, string $numArt)
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
