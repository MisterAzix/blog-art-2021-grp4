<?php
// CRUD LANGUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE
{
	function get_1Langue($numLang)
	{
	}

	function get_1LangueByPays($numLang)
	{
	}

	function get_AllLangues()
	{
	}

	function get_AllLanguesByPays()
	{
	}

	function create($numLang, $lib1Lang, $lib2Lang, $numPays)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete LANGUE : ' . $e->getMessage());
		}
	}

	function update($numLang, $lib1Lang, $lib2Lang, $numPays)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete LANGUE : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numLang)
	{
		global $db;
		try {
			$db->beginTransaction();



			$db->commit();
			$request->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete LANGUE : ' . $e->getMessage());
		}
	}
}	// End of class
