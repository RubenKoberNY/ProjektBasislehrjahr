-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE =
        'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- procedure getAntwortFromFrageId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `getAntwortFromFrageId`(IN frage_id_ int)
BEGIN
    SELECT antwort.id_antwort, antwort.antwortmöglichkeiten, antwort.richtigeantwort, antwort.punktezahl
    FROM antwort
             JOIN antwortfrage ON antwortfrage.antwort_id = antwort.id_antwort
    WHERE antwortfrage.frage_id = frage_id_;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure getAntwortIdAndAntwortTextFromFrageId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `getAntwortIdAndAntwortTextFromFrageId`(IN frage_id_ int)
BEGIN
    SELECT antwort.id_antwort 'id_answer', antwort.antwortmöglichkeiten 'value'
    FROM antwort
             JOIN antwortfrage ON antwortfrage.antwort_id = antwort.id_antwort
    WHERE antwortfrage.frage_id = frage_id_;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure getFrageAndAntwortFromQuizId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `getFrageAndAntwortFromQuizId`(IN quiz_id_ int)
BEGIN
    SELECT antwort.id_antwort,
           antwort.antwortmöglichkeiten,
           antwort.richtigeantwort,
           antwort.punktezahl,
           frage.id_frage,
           frage.fragetyp,
           frage.fragetext
    FROM antwort
             JOIN antwortfrage ON antwortfrage.antwort_id = antwort.id_antwort
             JOIN frage ON antwortfrage.frage_id = frage.id_frage
    WHERE frage.quiz_id = quiz_id_;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure getFrageFromQuizId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `getFrageFromQuizId`(IN quiz_id_ int)
BEGIN
    SELECT frage.id_frage, frage.fragetyp, frage.fragetext
    FROM frage
    WHERE frage.quiz_id = quiz_id_;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure getQuizFromGameId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `getQuizFromGameId`(IN gamecode_ varchar(6))
BEGIN
    SELECT Quiz
    FROM quiz
    WHERE id_quiz IN
          (SELECT quiz_id FROM gameid WHERE gamecode = gamecode_);
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure risiko_getAllFrage
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `risiko_getAllFrage`()
BEGIN
    SELECT frage.id_frage AS 'id_frage', frage.fragetext AS 'question'
    FROM frage
    WHERE frage.quiz_id = (SELECT id_quiz FROM quiz WHERE quiz = "Risiko");
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure risiko_getAntwortFromFrageId
-- -----------------------------------------------------

DELIMITER $$
USE `corona_prototype`$$
CREATE
    DEFINER = `testing`@`%` PROCEDURE `risiko_getAntwortFromFrageId`(IN frage_id_ int)
BEGIN
    SELECT antwort.id_antwort 'id_answer', antwort.antwortmöglichkeiten 'value'
    FROM antwort
             JOIN antwortfrage ON antwortfrage.antwort_id = antwort.id_antwort
    WHERE antwortfrage.frage_id = frage_id_;
END$$

DELIMITER ;

SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
