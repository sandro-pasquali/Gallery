-- MySQL dump 8.23
--
-- Host: localhost    Database: Gallery
---------------------------------------------------------
-- Server version	3.23.59-nightly-20050301

--
-- Table structure for table `artists`
--

CREATE TABLE artists (
  artistId int(11) NOT NULL auto_increment,
  firstName varchar(100) NOT NULL default '',
  middleName varchar(100) NOT NULL default '',
  lastName varchar(100) NOT NULL default '',
  bio text NOT NULL,
  showId int(11) default NULL,
  PRIMARY KEY  (artistId)
) TYPE=MyISAM;

--
-- Table structure for table `panels`
--

CREATE TABLE panels (
  panelId int(11) NOT NULL auto_increment,
  artistId int(11) NOT NULL default '0',
  showId int(11) default NULL,
  measurement varchar(32) default '',
  width varchar(32) default '0',
  height varchar(32) default '0',
  medium varchar(255) default '',
  notes varchar(255) default '',
  file varchar(255) NOT NULL default '',
  title varchar(255) NOT NULL default '',
  PRIMARY KEY  (panelId)
) TYPE=MyISAM;


--
-- Table structure for table `shows`
--

CREATE TABLE shows (
  showId int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  description blob NOT NULL,
  PRIMARY KEY  (showId)
) TYPE=MyISAM;

