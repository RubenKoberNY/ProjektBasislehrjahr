USE corona_prototype;

DROP PROCEDURE IF EXISTS getFrageAndAntwortFromQuiz;
DROP PROCEDURE IF EXISTS getFrageAndAntwortFromQuizId;
DROP PROCEDURE IF EXISTS getQuizFromGameId;
DROP PROCEDURE IF EXISTS getAntwortFromFrageId;
DROP PROCEDURE IF EXISTS getFrageFromQuizId;
DROP PROCEDURE IF EXISTS risiko_getAllFrage;
DROP PROCEDURE IF EXISTS risiko_getAntwortFromFrageId;

DELIMITER //
/*CREATE PROCEDURE getFrageAndAntwortFromQuiz (IN quiz_ varchar(45))
BEGIN
SELECT * FROM antwort
JOIN antwortfrage ON antwortfrage.antwort_id=antwort.id_antwort
JOIN frage ON antwortfrage.frage_id=frage.id_frage
WHERE frage.quiz_id IN (SELECT id_quiz FROM quiz WHERE quiz=quiz_);
END //
*/
CREATE PROCEDURE getFrageAndAntwortFromQuizId (IN quiz_id_ int)
BEGIN
SELECT antwort.id_antwort, antwort.antwortmöglichkeiten, antwort.richtigeantwort, antwort.punktezahl, frage.id_frage, frage.fragetyp, frage.fragetext FROM antwort
JOIN antwortfrage ON antwortfrage.antwort_id=antwort.id_antwort
JOIN frage ON antwortfrage.frage_id=frage.id_frage
WHERE frage.quiz_id = quiz_id_;
END//

CREATE PROCEDURE getFrageFromQuizId(IN quiz_id_ int)
BEGIN
SELECT frage.id_frage, frage.fragetyp, frage.fragetext FROM frage
WHERE frage.quiz_id = quiz_id_;
END//

CREATE PROCEDURE getAntwortFromFrageId(IN frage_id_ int)
BEGIN
SELECT antwort.id_antwort, antwort.antwortmöglichkeiten, antwort.richtigeantwort, antwort.punktezahl FROM antwort
JOIN antwortfrage ON antwortfrage.antwort_id=antwort.id_antwort
WHERE antwortfrage.frage_id=frage_id_;
END//

CREATE PROCEDURE getQuizFromGameId (IN gamecode_ varchar(6))
BEGIN
SELECT Quiz FROM quiz
WHERE id_quiz IN
(SELECT  quiz_id FROM gameid WHERE gamecode = gamecode_);
END//

CREATE PROCEDURE risiko_getAllFrage()
BEGIN
SELECT frage.id_frage AS 'id_frage', frage.fragetext AS 'question' FROM frage
WHERE frage.quiz_id = (SELECT id_quiz FROM quiz WHERE quiz ="Risiko");
END//

CREATE PROCEDURE risiko_getAntwortFromFrageId(IN frage_id_ int)
BEGIN
SELECT antwort.id_antwort 'id_answer', antwort.antwortmöglichkeiten 'value' FROM antwort
JOIN antwortfrage ON antwortfrage.antwort_id = antwort.id_antwort
WHERE antwortfrage.frage_id=frage_id_;
END//