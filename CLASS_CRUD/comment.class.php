<?php
// CRUD COMMENT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class COMMENT
{	
	/**
	 * get_1Comment Permet de récupérer un seul commentaire en base de donnée
	 *
	 * @param  mixed $numSeqCom
	 * @param  mixed $numArt
	 * @return object Renvoie un object comprenant les informations du commentaire récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1Comment(int $numSeqCom, int $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM comment WHERE numSeqCom=:numSeqCom AND numArt = :numArt");
		$query->execute([
			'numSeqCom' => $numSeqCom,
			'numArt' => $numArt
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllComments Permet de récupérer tous les commentaires en base de donnée
	 *
	 * @return array Renvoie un tableau d'object avec les informations de chaque commentaire
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllComments()
	{
		global $db;
		$query = $db->query('SELECT * FROM comment');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllCommentsByArticle Permet de récupérer tous les commentaires en base de donnée en fonction d'un article
	 *
	 * @param  mixed $numArt
	 * @return array Renvoie un tableau d'object avec les informations des commentaires récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllCommentsByArticle($numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM comment WHERE numArt=:numArt");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllowedMainCommentsByArticle Permet de récupérer tous les commentaires non logiquement supprimé d'un article
	 *
	 * @param  mixed $numArt
	 * @return array Renvoie un tableau d'object avec les informations des commentaires récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllowedMainCommentsByArticle(int $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM comment WHERE numArt = :numArt AND numSeqCom NOT IN (SELECT numSeqComR FROM commentplus WHERE numArt = :numArt) AND attModOK = 1 AND affComOK = 1 AND delLogiq = 0 ORDER BY dtCreCom DESC");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * get_AllCommentsByMembre Permet de récupérer tous les commentaires d'un membre
	 *
	 * @param  mixed $numMemb
	 * @return array Renvoie un tableau d'object avec les informations des commentaires récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllCommentsByMembre(int $numMemb)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM comment WHERE numMemb=:numMemb");
		$query->execute([
			'numMemb' => $numMemb
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllCommentsPlusByArticle(int $numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM commentplus WHERE numArt=:numArt ORDER BY numSeqCom");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
	/**
	 * create Permet d'ajouter un nouveau commentaire en base de donnée
	 *
	 * @param  mixed $numArt
	 * @param  mixed $libCom
	 * @param  mixed $numMemb
	 * @return object
	 * @return void
	 */
	function create(int $numArt, string $libCom, int $numMemb)
	{
		global $db;
		require_once __DIR__ . '/getNextNumCom.php';
		$numSeqCom = getNextNumCom($numArt);
		try {
			$db->beginTransaction();
			$query = $db->prepare("INSERT INTO comment (numSeqCom, numArt, dtCreCom, libCom, attModOK, affComOK, numMemb) VALUES (:numSeqCom, :numArt, NOW(), :libCom, 1, 1, :numMemb)");
			$query->execute([
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt,
				'libCom' => $libCom,
				'numMemb' => $numMemb
			]);
			$db->commit();
			$query->closeCursor();
			$result = $this->get_1Comment($numSeqCom, $numArt);
			return $result;
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur create COMMENT : ' . $e->getMessage());
		}
	}
	
	/**
	 * update Permet de modifier le contenu d'un commentaire
	 *
	 * @param  mixed $numSeqCom
	 * @param  mixed $numArt
	 * @param  mixed $libCom
	 * @param  mixed $numMemb
	 * @return void
	 */
	function update(int $numSeqCom, int $numArt, string $libCom, int $numMemb)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE comment SET libCom = :libCom WHERE numSeqCom=:numSeqCom AND numArt=:numArt');
			$query->execute([
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt,
				'libCom' => $libCom
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update COMMENT : ' . $e->getMessage());
		}
	}
	
	/**
	 * modDelete Permet à un modérateur de bannir un commentaire
	 *
	 * @param  mixed $numSeqCom
	 * @param  mixed $numArt
	 * @param  mixed $notifComKOAff
	 * @return void
	 */
	function modDelete(int $numSeqCom, int $numArt, string $notifComKOAff)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE comment SET attModOK = 0, affComOK = 0, notifComKOAff = :notifComKOAff WHERE numSeqCom=:numSeqCom AND numArt=:numArt');
			$query->execute([
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt,
				'notifComKOAff' => $notifComKOAff
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur mod delete COMMENT : ' . $e->getMessage());
		}
	}
	
	/**
	 * delete Permet la suppression logique d'un commentaire
	 *
	 * @param  mixed $numSeqCom
	 * @param  mixed $numArt
	 * @return void
	 */
	function delete(int $numSeqCom, int $numArt) //Logical delete
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE comment SET delLogiq = 1 WHERE numSeqCom=:numSeqCom AND numArt=:numArt');
			$query->execute([
				'numSeqCom' => $numSeqCom,
				'numArt' => $numArt,
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete COMMENT : ' . $e->getMessage());
		}
	}
}	// End of class
