<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230111093922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribution (id INT AUTO_INCREMENT NOT NULL, employe_id_id INT NOT NULL, ligne_id_id INT NOT NULL, terminal_id_id INT NOT NULL, INDEX IDX_C751ED49325980C0 (employe_id_id), INDEX IDX_C751ED497CE87467 (ligne_id_id), INDEX IDX_C751ED49CF2FC8D0 (terminal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forfait (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, format_sim VARCHAR(255) NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, liste_id_id INT DEFAULT NULL, forfait_id_id INT DEFAULT NULL, reference INT NOT NULL, mise_service VARCHAR(255) NOT NULL, fin_engagement VARCHAR(255) NOT NULL, facturation VARCHAR(255) NOT NULL, portage INT NOT NULL, csim INT DEFAULT NULL, numero_prive INT DEFAULT NULL, changement_terminal VARCHAR(255) DEFAULT NULL, modification_forfait VARCHAR(255) DEFAULT NULL, ligne_secondaire TINYINT(1) DEFAULT NULL, ligne_principale INT DEFAULT NULL, master_id_acces INT DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, INDEX IDX_57F0DB8360BF4AF9 (liste_id_id), INDEX IDX_57F0DB835936265A (forfait_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, total INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE terminal (id INT AUTO_INCREMENT NOT NULL, achete VARCHAR(255) NOT NULL, communiquant VARCHAR(255) NOT NULL, imei_achete VARCHAR(255) NOT NULL, imei_communiquant VARCHAR(255) NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED49325980C0 FOREIGN KEY (employe_id_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED497CE87467 FOREIGN KEY (ligne_id_id) REFERENCES ligne (id)');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED49CF2FC8D0 FOREIGN KEY (terminal_id_id) REFERENCES terminal (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB8360BF4AF9 FOREIGN KEY (liste_id_id) REFERENCES liste (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB835936265A FOREIGN KEY (forfait_id_id) REFERENCES forfait (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribution DROP FOREIGN KEY FK_C751ED49325980C0');
        $this->addSql('ALTER TABLE attribution DROP FOREIGN KEY FK_C751ED497CE87467');
        $this->addSql('ALTER TABLE attribution DROP FOREIGN KEY FK_C751ED49CF2FC8D0');
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB8360BF4AF9');
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB835936265A');
        $this->addSql('DROP TABLE attribution');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE forfait');
        $this->addSql('DROP TABLE ligne');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE terminal');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
