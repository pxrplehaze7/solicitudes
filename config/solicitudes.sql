CREATE DATABASE solicitudes;
USE solicitudes;



CREATE TABLE `solicitudes`.`tl_situacion` (
    `IDSit` INT NOT NULL AUTO_INCREMENT,
    `sit_tipo_situacion` VARCHAR (70) NOT NULL,
    PRIMARY KEY (`IDSit`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

INSERT INTO `tl_situacion`(`IDSit`,`sit_tipo_situacion`)
VAlUES (1, 'A) Cuidado personal de al menos un niño o niña en etapa preescolar.');

INSERT INTO `tl_situacion`(`IDSit`,`sit_tipo_situacion`)
VAlUES (2, 'B) Cuidado personal de al menos un niño o niña menor de 12 años.');

INSERT INTO `tl_situacion`(`IDSit`,`sit_tipo_situacion`)
VAlUES (3, 'C) Cuidado personas con alguna discapacidad.');







CREATE TABLE `solicitudes`.`cpp_motivo` (
    `IDMotivo` INT NOT NULL AUTO_INCREMENT,
    `nomb_motivo` VARCHAR (100),
    PRIMARY KEY (IDMotivo)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

INSERT INTO `cpp_motivo` (`IDMotivo`,`nomb_motivo`)
VALUES (1, 'Solicitud de reemplazo');

INSERT INTO `cpp_motivo` (`IDMotivo`,`nomb_motivo`)
VALUES (2, 'Solicitud de destinación');

INSERT INTO `cpp_motivo` (`IDMotivo`,`nomb_motivo`)
VALUES (3, 'Solicitud de pago de asignación');





CREATE TABLE `solicitudes`.`ss_situacion` (
    `IDTipoS` INT NOT NULL AUTO_INCREMENT,
    `tipoS_tipo_solicitud` VARCHAR (150),
    PRIMARY KEY (IDTipoS)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

INSERT INTO `ss_situacion` (`IDTipoS`, `tipoS_tipo_solicitud`)
VALUES (1, 'Estudio de puesto de trabajo.');

INSERT INTO `ss_situacion` (`IDTipoS`, `tipoS_tipo_solicitud`)
VALUES (2,'Inspección de condiciones subestandar.');

INSERT INTO `ss_situacion` (`IDTipoS`, `tipoS_tipo_solicitud`)
VALUES (3,'Asesoría técnica S & SO.');

INSERT INTO `ss_situacion` (`IDTipoS`, `tipoS_tipo_solicitud`)
VALUES (4,'Otro.');






CREATE TABLE `solicitudes`.`usuario_solicitudes`(
    `IDUsu` INT NOT NULL AUTO_INCREMENT,
    `usuario_nombre` VARCHAR (300),
    `usuario_rut` VARCHAR (10),
    `usuario_correo` VARCHAR (100),
    `usuario_contrasenna` VARCHAR (300),
    `usuario_rol` BOOLEAN,
    `firma` VARCHAR (400),
    PRIMARY KEY (IDUsu)
)ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;
















CREATE TABLE `solicitudes`.`funcionarios_TEA` (
    `IDFTEA` INT NOT NULL AUTO_INCREMENT,
    `IDUsu` INT NOT NULL,
    `IDLugar` INT NOT NULL,
    `ftea_num_formulario` INT (10) NOT NULL,
    `ftea_nomb_funcionario` VARCHAR (250) NOT NULL,
    `ftea_rut_funcionario` VARCHAR (10) NOT NULL,
    `ftea_estamento` VARCHAR (150) NOT NULL,
    `ftea_nomb_ninno` VARCHAR (250) NOT NULL,
    `ftea_rut_ninno` VARCHAR (10) NOT NULL,
    `ftea_firma_solicitante` VARCHAR (400) NULL,
    `ftea_pdf_diagnostico` VARCHAR (400) NULL,
    `ftea_pdf_nacimiento` VARCHAR (400) NULL,
    `ftea_firma_direct_cesfam` VARCHAR (400) NULL,
    `ftea_firma_subdirect_das` VARCHAR (400) NULL,
    `ftea_firma_ugestion` VARCHAR (400) NULL,
    `ftea_fecha_solicitud` DATE NOT NULL,
        `ftea_estado_solicitud` TINYINT (1) NOT NULL,
        `ftea_fecha_ingreso_das` DATE NULL,
        `ftea_nomb_registra` VARCHAR (250) NOT NULL,
        `ftea_fecha_resolucion` DATE NULL,
        `ftea_num_decreto` INT (5) NULL,
        `ftea_observaciones` VARCHAR (1000) NULL,
        PRIMARY KEY (IDFTEA),
        FOREIGN KEY (IDUsu) REFERENCES `solicitudes`.usuario_solicitudes (`IDUsu`),
        FOREIGN KEY (IDLugar) REFERENCES `das`.lugar (`IDLugar`)

) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;






















CREATE TABLE `solicitudes`.`teletrabajo` (
    `IDTL` INT NOT NULL, 
    `IDLugar` INT NOT NULL,
    `IDSit` INT NOT NULL,
    `tele_num_formulario` INT (10) NOT NULL
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;















CREATE TABLE `solicitudes`.`cpp_motivo` (
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;

CREATE TABLE `solicitudes`.`cpp_motivo` (
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;




