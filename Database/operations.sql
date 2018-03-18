/*Functions*/

/*Función que determina si el usuario puede ingresar o no a una sucursal dependiendo del tipo de membresía que tinene.*/
CREATE OR REPLACE FUNCTION allowed (member_id INTEGER, branch_id INTEGER) 
RETURNS boolean AS $allowed$
    DECLARE
        allowed boolean;
        member_branch_id integer;
        membership membership_type;
    BEGIN
        SELECT m.branch_id, m.membership
        INTO member_branch_id, membership
        FROM members m
        WHERE m.id = member_id;

        allowed := true;

        IF(membership = 'premium'::membership_type) THEN
            allowed := true;
        ELSIF (member_branch_id = branch_id) THEN
            allowed := true;
        ELSE
            allowed:= false;
        END IF;

        RETURN allowed;
    END; 
$allowed$ LANGUAGE plpgsql;

/*Procedures*/

/*Desinscribe a un miembro de una clase*/
CREATE OR REPLACE FUNCTION unsubscribe(member INTEGER, schedule INTEGER) 
RETURNS void AS $$
    BEGIN
        LOCK TABLE member_schedule IN EXCLUSIVE MODE;
        
        DELETE FROM member_schedule ms
        WHERE ms.member_id = member AND ms.schedule_id = schedule;
        
        RETURN;
    END; 
$$ LANGUAGE plpgsql;



/*Triggers*/

/*Desinscribe a un miembro de una clase*/
CREATE OR REPLACE FUNCTION checkAbsences() 
RETURNS trigger AS $after_update_member_schedule$
    BEGIN
        LOCK TABLE member_schedule IN EXCLUSIVE MODE;

        IF(NEW.absences >= 3) THEN
            PERFORM unsubscribe(OLD.member_id, OLD.schedule_id);
        END IF;

        RETURN NEW;
    END; 
$after_update_member_schedule$ LANGUAGE plpgsql;

CREATE TRIGGER after_update_member_schedule AFTER UPDATE ON member_schedule
FOR EACH ROW EXECUTE PROCEDURE checkAbsences();