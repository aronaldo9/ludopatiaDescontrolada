<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119115841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_sorteo DROP FOREIGN KEY FK_A1D1F2B663FD436');
        $this->addSql('ALTER TABLE ticket_sorteo DROP FOREIGN KEY FK_A1D1F2B700047D2');
        $this->addSql('DROP TABLE ticket_sorteo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket_sorteo (ticket_id INT NOT NULL, sorteo_id INT NOT NULL, INDEX IDX_A1D1F2B700047D2 (ticket_id), INDEX IDX_A1D1F2B663FD436 (sorteo_id), PRIMARY KEY(ticket_id, sorteo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ticket_sorteo ADD CONSTRAINT FK_A1D1F2B663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_sorteo ADD CONSTRAINT FK_A1D1F2B700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
    }
}
