<?php
// CRUD LANGUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE
{
	function get_1Langue($numLang)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM langue WHERE numLang=:numLang");
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_1LangueByPays($numLang, $numPays)
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

	function get_AllLangues()
	{
		global $db;
		$query = $db->query('SELECT * FROM langue');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllLanguesByPays($numPays)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM langue WHERE numPays=:numPays");
		$query->execute([
			'numPays' => $numPays
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllPays()
	{
		global $db;
		$query = $db->query('SELECT * FROM pays');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function create($lib1Lang, $lib2Lang, $numPays)
	{
		global $db;
		require_once __DIR__ . '/../../CLASS_CRUD/getNextNumLang.php';
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

	function update($numLang, $lib1Lang, $lib2Lang)
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

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numLang)
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
