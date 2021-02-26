<?php
// CRUD ARTICLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ARTICLE
{
	/**
	 * get_1Article Permet de récupérer un seul article en base de donnée
	 *
	 * @param  string $numArt
	 * @return object Renvoie un object comprenant les informations de l'article récupéré
	 */
	function get_1Article($numArt): object
	{
		global $db;
		$query = $db->prepare("SELECT * FROM article WHERE numArt=:numArt");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllArticles Permet de récupérer tous les articles en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les articles
	 */
	function get_AllArticles(): array
	{
		global $db;
		$query = $db->query('SELECT * FROM article');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllFavArticles Permet de récupérer les articles les plus likés
	 *
	 * @return array Retourne un tableau comprenant les 3 articles les plus likés
	 */
	function get_AllFavArticles(): array
	{
		global $db;
		$query = $db->query('SELECT libTitrArt, libAccrochArt, l.numArt, count(likeA) count FROM article a INNER JOIN likeart l on a.numArt = l.numArt GROUP BY l.numArt ORDER BY count DESC LIMIT 3');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllArticlesByAngl Permet de récupérer tous les article en base de donnée en fonction d'un angle
	 *
	 * @param  string $numAngl
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les articles récupérés
	 */
	function get_AllArticlesByAngl($numAngl): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM article WHERE numAngl = :numAngl');
		$query->execute([
			'numAngl' => $numAngl
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	/**
	 * get_AllArticlesByThem Permet de récupérer tous les article en base de donnée en fonction d'une thématique
	 *
	 * @param  string $numThem
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les articles récupérés
	 */
	function get_AllArticlesByThem($numThem): array
	{
		global $db;
		$query = $db->prepare('SELECT * FROM article WHERE numThem = :numThem');
		$query->execute([
			'numThem' => $numThem
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	/**
	 * create Permet d'ajouter un nouvel article en base de donnée
	 *
	 * @param  string $dtCreArt
	 * @param  string $libTitrArt
	 * @param  string $libChapoArt
	 * @param  string $libAccrochArt
	 * @param  string $parag1Art
	 * @param  string $libSsTitr1Art
	 * @param  string $parag2Art
	 * @param  string $libSsTitr2Art
	 * @param  string $parag3Art
	 * @param  string $libConclArt
	 * @param  string $urlPhotArt
	 * @param  string $numAngl
	 * @param  string $numThem
	 * @return void
	 */
	function create(
		string $dtCreArt,
		string $libTitrArt,
		string $libChapoArt,
		string $libAccrochArt,
		string $parag1Art,
		string $libSsTitr1Art,
		string $parag2Art,
		string $libSsTitr2Art,
		string $parag3Art,
		string $libConclArt,
		string $urlPhotArt,
		string $numAngl,
		string $numThem
	) {
		global $db;
		require_once __DIR__ . '/getNextNumAngl.php';
		//$numAngl = getNextNumAngl($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare(
				'INSERT INTO article (dtCreArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, 
				libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numAngl, numThem)
				VALUES (:dtCreArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, 
				:parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numAngl, :numThem)'
			);
			$query->execute([
				'dtCreArt' => $dtCreArt,
				'libTitrArt' => $libTitrArt,
				'libChapoArt' => $libChapoArt,
				'libAccrochArt' => $libAccrochArt,
				'parag1Art' => $parag1Art,
				'libSsTitr1Art' => $libSsTitr1Art,
				'parag2Art' => $parag2Art,
				'libSsTitr2Art' => $libSsTitr2Art,
				'parag3Art' => $parag3Art,
				'libConclArt' => $libConclArt,
				'urlPhotArt' => $urlPhotArt,
				'numAngl' => $numAngl,
				'numThem' => $numThem
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert ARTICLE : ' . $e->getMessage());
		}
	}

	/**
	 * update Permet de modifier un article dans la base de donnée
	 *
	 * @param  string $numArt
	 * @param  string $libTitrArt
	 * @param  string $libChapoArt
	 * @param  string $libAccrochArt
	 * @param  string $parag1Art
	 * @param  string $libSsTitr1Art
	 * @param  string $parag2Art
	 * @param  string $libSsTitr2Art
	 * @param  string $parag3Art
	 * @param  string $libConclArt
	 * @param  string $urlPhotArt
	 * @param  string $numAngl
	 * @param  string $numThem
	 * @return void
	 */
	function update(
		string $numArt,
		string $libTitrArt,
		string $libChapoArt,
		string $libAccrochArt,
		string $parag1Art,
		string $libSsTitr1Art,
		string $parag2Art,
		string $libSsTitr2Art,
		string $parag3Art,
		string $libConclArt,
		string $urlPhotArt,
		string $numAngl,
		string $numThem
	) {
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE article SET libTitrArt = :libTitrArt, libChapoArt = :libChapoArt, 
			libAccrochArt = :libAccrochArt, parag1Art = :parag1Art, libSsTitr1Art = :libSsTitr1Art, parag2Art = :parag2Art, 
			libSsTitr2Art = :libSsTitr2Art, parag3Art = :parag3Art, libConclArt = :libConclArt, urlPhotArt = :urlPhotArt, 
			numAngl = :numAngl, numThem = :numThem WHERE numArt = :numArt');
			$query->execute([
				'numArt' => $numArt,
				'libTitrArt' => $libTitrArt,
				'libChapoArt' => $libChapoArt,
				'libAccrochArt' => $libAccrochArt,
				'parag1Art' => $parag1Art,
				'libSsTitr1Art' => $libSsTitr1Art,
				'parag2Art' => $parag2Art,
				'libSsTitr2Art' => $libSsTitr2Art,
				'parag3Art' => $parag3Art,
				'libConclArt' => $libConclArt,
				'urlPhotArt' => $urlPhotArt,
				'numAngl' => $numAngl,
				'numThem' => $numThem
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update ARTICLE : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet de supprimer un article de la base de donnée
	 *
	 * @param  string $numArt
	 * @return void
	 */
	function delete(string $numArt)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM article WHERE numArt=:numArt');
			$query->execute([
				'numArt' => $numArt
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete ARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
