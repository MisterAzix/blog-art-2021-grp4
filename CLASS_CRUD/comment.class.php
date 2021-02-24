<?php
// CRUD COMMENT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class COMMENT
{
	function get_1Comment($numSeqCom, $numArt)
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

	function get_AllComments()
	{
		global $db;
		$query = $db->query('SELECT * FROM comment');
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

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

	function get_AllCommentsPlusByArticle($numArt)
	{
		global $db;
		$query = $db->prepare("SELECT * FROM commentplus WHERE numArt=:numArt ORDER BY numSeqCom");
		$query->execute([
			'numArt' => $numArt
		]);
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}

	/*function create($lib1Lang, $lib2Lang, $numPays)
	{
		global $db;
		require_once __DIR__ . '/getNextNumLang.php';
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
			die('Erreur create COMMENT : ' . $e->getMessage());
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
			die('Erreur update COMMENT : ' . $e->getMessage());
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
			die('Erreur delete COMMENT : ' . $e->getMessage());
		}
	}*/
}	// End of class
