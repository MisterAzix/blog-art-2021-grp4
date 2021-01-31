<?php
// CRUD THEMATIQUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class THEMATIQUE
{
	function get_1Thematique($numThem)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM thematique WHERE numThem=:numThem");
		$query->execute([
			'numThem' => $numThem
		]);
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllThematiques()
	{
		global $db;
		$query = $db->query('SELECT * FROM thematique');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	function get_AllThematiquesByLang($numLang){
		global $db;
		$query = $db->prepare('SELECT * FROM thematique WHERE numLang = :numLang');
		$query->execute([
			'numLang' => $numLang
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return ($result);
	}

	function create($libThem, $numLang)
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

	function update($numThem, $libThem)
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

	function delete($numThem)
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
