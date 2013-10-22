<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131023004444 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE permissions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) DEFAULT NULL, parent_id INT DEFAULT NULL, INDEX parent_id (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE roles_permissions (role_id INT NOT NULL, perm_id INT NOT NULL, INDEX IDX_CEC2E043D60322AC (role_id), INDEX IDX_CEC2E043FA6311EF (perm_id), PRIMARY KEY(role_id, perm_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE roles_permissions ADD CONSTRAINT FK_CEC2E043D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)");
        $this->addSql("ALTER TABLE roles_permissions ADD CONSTRAINT FK_CEC2E043FA6311EF FOREIGN KEY (perm_id) REFERENCES permissions (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE roles_permissions DROP FOREIGN KEY FK_CEC2E043FA6311EF");
        $this->addSql("ALTER TABLE roles_permissions DROP FOREIGN KEY FK_CEC2E043D60322AC");
        $this->addSql("DROP TABLE permissions");
        $this->addSql("DROP TABLE roles");
        $this->addSql("DROP TABLE roles_permissions");
    }
}
