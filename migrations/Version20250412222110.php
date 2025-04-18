<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250412222110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_plate (menu_id INT NOT NULL, plate_id INT NOT NULL, INDEX IDX_E032F43CCCD7E912 (menu_id), INDEX IDX_E032F43CDF66E98B (plate_id), PRIMARY KEY(menu_id, plate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plate ADD CONSTRAINT FK_E032F43CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plate ADD CONSTRAINT FK_E032F43CDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_desserts DROP FOREIGN KEY FK_2E4A95F7CCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_desserts DROP FOREIGN KEY FK_2E4A95F7DF66E98B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_entrees DROP FOREIGN KEY FK_AC39571FCCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_entrees DROP FOREIGN KEY FK_AC39571FDF66E98B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats DROP FOREIGN KEY FK_14E6416DCCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats DROP FOREIGN KEY FK_14E6416DDF66E98B
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE article
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_desserts
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_entrees
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_plats
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_desserts (menu_id INT NOT NULL, plate_id INT NOT NULL, INDEX IDX_2E4A95F7CCD7E912 (menu_id), INDEX IDX_2E4A95F7DF66E98B (plate_id), PRIMARY KEY(menu_id, plate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_entrees (menu_id INT NOT NULL, plate_id INT NOT NULL, INDEX IDX_AC39571FCCD7E912 (menu_id), INDEX IDX_AC39571FDF66E98B (plate_id), PRIMARY KEY(menu_id, plate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_plats (menu_id INT NOT NULL, plate_id INT NOT NULL, INDEX IDX_14E6416DCCD7E912 (menu_id), INDEX IDX_14E6416DDF66E98B (plate_id), PRIMARY KEY(menu_id, plate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_desserts ADD CONSTRAINT FK_2E4A95F7CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_desserts ADD CONSTRAINT FK_2E4A95F7DF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_entrees ADD CONSTRAINT FK_AC39571FCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_entrees ADD CONSTRAINT FK_AC39571FDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats ADD CONSTRAINT FK_14E6416DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats ADD CONSTRAINT FK_14E6416DDF66E98B FOREIGN KEY (plate_id) REFERENCES plate (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plate DROP FOREIGN KEY FK_E032F43CCCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plate DROP FOREIGN KEY FK_E032F43CDF66E98B
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_plate
        SQL);
    }
}
