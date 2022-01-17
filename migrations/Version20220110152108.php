<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110152108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_reactions (id INT AUTO_INCREMENT NOT NULL, comment_like INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, posts_id INT NOT NULL, user_id INT NOT NULL, comment_message VARCHAR(255) NOT NULL, INDEX IDX_5F9E962AD5E258C5 (posts_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE connections (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE followers (id INT AUTO_INCREMENT NOT NULL, follower_user_id INT DEFAULT NULL, INDEX IDX_8408FDA770FC2906 (follower_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE following (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_reactions (id INT AUTO_INCREMENT NOT NULL, post_like INT DEFAULT NULL, post_hate INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, post_title VARCHAR(255) DEFAULT NULL, post_description VARCHAR(255) DEFAULT NULL, post_filename VARCHAR(255) NOT NULL, INDEX IDX_885DBAFAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reply_comment (id INT AUTO_INCREMENT NOT NULL, reply_comment_user_id INT NOT NULL, reply_comment_post_id INT NOT NULL, reply_comment_cmt_id INT NOT NULL, reply_comment_message VARCHAR(255) NOT NULL, INDEX IDX_89CA3BAECA00D9CF (reply_comment_user_id), INDEX IDX_89CA3BAE26E70976 (reply_comment_post_id), INDEX IDX_89CA3BAE90B3F557 (reply_comment_cmt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, following_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, location VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, profile_photo VARCHAR(255) DEFAULT NULL, cover_photo VARCHAR(255) DEFAULT NULL, about_info VARCHAR(255) DEFAULT NULL, pass VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D6491816E3A3 (following_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_gallery (id INT AUTO_INCREMENT NOT NULL, gallery_user_id INT NOT NULL, uploaded_filenames VARCHAR(255) NOT NULL, uploaded_filetype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1F2666309F1492BD (gallery_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE followers ADD CONSTRAINT FK_8408FDA770FC2906 FOREIGN KEY (follower_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reply_comment ADD CONSTRAINT FK_89CA3BAECA00D9CF FOREIGN KEY (reply_comment_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reply_comment ADD CONSTRAINT FK_89CA3BAE26E70976 FOREIGN KEY (reply_comment_post_id) REFERENCES posts (id)');
        $this->addSql('ALTER TABLE reply_comment ADD CONSTRAINT FK_89CA3BAE90B3F557 FOREIGN KEY (reply_comment_cmt_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491816E3A3 FOREIGN KEY (following_id) REFERENCES following (id)');
        $this->addSql('ALTER TABLE user_gallery ADD CONSTRAINT FK_1F2666309F1492BD FOREIGN KEY (gallery_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reply_comment DROP FOREIGN KEY FK_89CA3BAE90B3F557');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491816E3A3');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AD5E258C5');
        $this->addSql('ALTER TABLE reply_comment DROP FOREIGN KEY FK_89CA3BAE26E70976');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE followers DROP FOREIGN KEY FK_8408FDA770FC2906');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('ALTER TABLE reply_comment DROP FOREIGN KEY FK_89CA3BAECA00D9CF');
        $this->addSql('ALTER TABLE user_gallery DROP FOREIGN KEY FK_1F2666309F1492BD');
        $this->addSql('DROP TABLE comment_reactions');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE connections');
        $this->addSql('DROP TABLE followers');
        $this->addSql('DROP TABLE following');
        $this->addSql('DROP TABLE post_reactions');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE reply_comment');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_gallery');
    }
}
