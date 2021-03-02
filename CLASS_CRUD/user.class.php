<?php
// CRUD USER (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class USER
{
	function get_1User($pseudoUser/*, $passUser*/)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM user WHERE pseudoUser=:pseudoUser');
		$query->execute([
			'pseudoUser' => $pseudoUser
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_1UserByEmail($emailUser)
	{
		global $db;
		$query = $db->prepare('SELECT password FROM user WHERE emailUser=:emailUser');
		$query->execute([
			'emailUser' => $emailUser
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllUsers()
	{
		global $db;
		$query = $db->query('SELECT * FROM user');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/*function get_ExistPseudo($pseudoUser)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM user WHERE pseudoUser=:pseudoUser');
		$query->execute([
			'pseudoUser' => $pseudoUser
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}*/

	function get_NbAllUsersByidStat($idStat)
	{
		global $db;
		$query = $db->prepare('SELECT * FROM user US INNER JOIN statut ST ON US.idStat = ST.idStat WHERE ST.idStat = :idStat');
		$query->execute([
			'idStat' => $idStat
		]);
		$allNbUsersByStat = $query->fetchAll(PDO::FETCH_OBJ);
		return $allNbUsersByStat;
	}

	function create($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('INSERT INTO user (pseudoUser, passUser, nomUser, prenomUser, emailUser, idStat) VALUES (:pseudoUser, :passUser, :nomUser, :prenomUser, :emailUser, :idStat)');
			$query->execute([
				'pseudoUser' => $pseudoUser,
				'passUser' => $passUser,
				'nomUser' => $nomUser,
				'prenomUser' => $prenomUser,
				'emailUser' => $emailUser,
				'idStat' => $idStat
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert USER : ' . $e->getMessage());
		}
	}

	function update($pseudoUser, $passUser, $nomUser, $prenomUser, $emailUser, $idStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('UPDATE user SET pseudoUser=:pseudoUser, passUser=:passUser, nomUser=:nomUser, prenomUser=:prenomUser, emailUser=:emailUser, idStat=:idStat  WHERE pseudoUser=:pseudoUser');
			$query->execute([
				'pseudoUser' => $pseudoUser,
				'passUser' => $passUser,
				'nomUser' => $nomUser,
				'prenomUser' => $prenomUser,
				'emailUser' => $emailUser,
				'idStat' => $idStat
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur update USER : ' . $e->getMessage());
		}
	}

	function delete($pseudoUser, $passUser)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = $db->prepare('SELECT passUser FROM user WHERE pseudoUser=:pseudoUser');
			$query->execute([
				'pseudoUser' => $pseudoUser
			]);
			$password = $query->fetch(PDO::FETCH_OBJ)->passUser;
			if (password_verify($passUser, $password)) {
				$query = $db->prepare('DELETE FROM user WHERE pseudoUser=:pseudoUser');
				$query->execute([
					'pseudoUser' => $pseudoUser
				]);
			}
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur delete USER : ' . $e->getMessage());
		}
	}
}	// End of class
