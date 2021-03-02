<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ANGLE
{	
	/**
	 * get_1Angle Permet de récuper un seul angle en base de donnée
	 *
	 * @param  string $numAngl
	 * @return object Renvoie un object comprenant les informations de l'angle récupéré
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_1Angle(string $numAngl)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM angle WHERE numAngl=:numAngl");
		$query->execute([
			'numAngl' => $numAngl
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllAngles Permet de récupérer tous les angles en base de donnée
	 *
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les angles
	 */
	function get_AllAngles()
	{
		global $db;
		$query = $db->query('SELECT * FROM angle');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/**
	 * get_AllAnglesByLang Permet de récupérer tous les angles en base de donnée en fonction d'une langue
	 *
	 * @param  string $numLang
	 * @return array Renvoie un tableau d'object comprenant les informations de tous les angles récupérés
	 * @return bool false si rien n'est trouvé en base de donnée
	 */
	function get_AllAnglesByLang(string $numLang)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM angle WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	/**
	 * create Permet d'ajouter un nouvel angle en base de donnée
	 *
	 * @param  string $libAngl
	 * @param  string $numLang
	 * @return void
	 */
	function create(string $libAngl, string $numLang)
	{
		global $db;
		require_once __DIR__ . '/getNextNumAngl.php';
		$numAngl = getNextNumAngl($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO angle (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl,
				'numLang' => $numLang
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert ANGLE : ' . $e->getMessage());
		}
	}
	
	/**
	 * update Permet de modifier un angle dans la base de donnée
	 *
	 * @param  string $numAngl
	 * @param  string $libAngl
	 * @return void
	 */
	function update(string $numAngl, string $libAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE angle SET libAngl = :libAngl WHERE numAngl = :numAngl');
			$query->execute([
				'numAngl' => $numAngl,
				'libAngl' => $libAngl
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update ANGLE : ' . $e->getMessage());
		}
	}

	/**
	 * delete Permet de supprimer un angle de la base de donnée
	 *
	 * @param  string $numAngl
	 * @return void
	 */
	function delete(string $numAngl)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('DELETE FROM angle WHERE numAngl=:numAngl');
			$query->execute([
				'numAngl' => $numAngl
			]);
			$db->commit();
			$query->closeCursor();
			return $query->rowCount();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete ANGLE : ' . $e->getMessage());
		}
	}
}	// End of class
