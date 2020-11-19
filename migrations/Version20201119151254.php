<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119151254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantity_recipe (quantity_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_D730FC257E8B4AFC (quantity_id), INDEX IDX_D730FC2559D8A214 (recipe_id), PRIMARY KEY(quantity_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantity_recipe ADD CONSTRAINT FK_D730FC257E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quantity_recipe ADD CONSTRAINT FK_D730FC2559D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quantity_recipe');
    }
}
