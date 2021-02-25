<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225061430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE _adherent_debtor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE _invoices (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, debtor_id INT DEFAULT NULL, series VARCHAR(25) NOT NULL, number VARCHAR(255) NOT NULL, issue_date DATETIME NOT NULL, due_date DATETIME NOT NULL, currency VARCHAR(3) NOT NULL, requested_amount DOUBLE PRECISION NOT NULL, paid_amount DOUBLE PRECISION NOT NULL, balance DOUBLE PRECISION NOT NULL, invoice_amount DOUBLE PRECISION NOT NULL, approved_amount DOUBLE PRECISION NOT NULL, INDEX IDX_44EF6AF525F06C53 (adherent_id), INDEX IDX_44EF6AF5B043EC6B (debtor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE _invoices ADD CONSTRAINT FK_44EF6AF525F06C53 FOREIGN KEY (adherent_id) REFERENCES _adherent_debtor (id)');
        $this->addSql('ALTER TABLE _invoices ADD CONSTRAINT FK_44EF6AF5B043EC6B FOREIGN KEY (debtor_id) REFERENCES _adherent_debtor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE _invoices DROP FOREIGN KEY FK_44EF6AF525F06C53');
        $this->addSql('ALTER TABLE _invoices DROP FOREIGN KEY FK_44EF6AF5B043EC6B');
        $this->addSql('DROP TABLE _adherent_debtor');
        $this->addSql('DROP TABLE _invoices');
    }
}
