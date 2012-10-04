<?php

class model {

  private $table_name;

  function model($table_name = null) {
    $this->table_name = $table_name;
  }

  function load($id, $multiple = false) {
    if (is_array($id)) {
      if (!count($id)) {
        return (object)array();
      }
      $sql = "SELECT * FROM " . $this->table_name . " WHERE ";
      $where = array();
      foreach ($id as $key => $value)
      {
        $where[] = "`{$key}` = " . db::quote($value);
      }
      if ($multiple) {
        $return = db::fetchAll($sql . implode(' AND ', $where), 'model');
      }
      else {
        $return = db::fetchRow($sql . implode(' AND ', $where), 'model');
      }
    }
    else
    {
      if ($multiple) {
        $return = db::fetchRow("SELECT * FROM " . $this->table_name . " WHERE id=" . db::quote($id), 'model');
      }
      else {
        $return = db::fetchRow("SELECT * FROM " . $this->table_name . " WHERE id=" . db::quote($id), 'model');
      }
    }
    if ($multiple) {
      foreach($return as $delta => $value) {
        $return[$delta]->table_name = $this->table_name;
      }
    }
    else {
      $return->table_name = $this->table_name;
    }
    return $return;
  }

  function insert($values) {
    $field = array_keys($values);
    $val = array();
    foreach ($values as $value)
    {
      $val[] = db::quote($value);
    }
    db::query("INSERT INTO " . $this->table_name . " (`" . implode('`,`', $field) . "`) VALUES(" . implode(',', $val) . ")");
    return db::fetchValue("SELECT id FROM " . $this->table_name . " ORDER BY id DESC LIMIT 1");
  }

  function update($id, $values) {
    $id = static::load($id)->id;
    if (empty($id)) {
      return;
    }
    $part = array();
    foreach ($values as $field => $value)
    {
      $part[] = "`" . $field . "` = " . db::quote($value);
    }
    db::query("UPDATE " . $this->table_name . " SET " . implode(', ', $part) . " WHERE id = " . intval($id) . " LIMIT 1");
  }

  function delete($id) {
    $id = static::load($id)->id;
    if (empty($id)) {
      return;
    }
    db::query("DELETE FROM " . $this->table_name . " WHERE id = " . intval($id) . " LIMIT 1");
  }
}


class db {
  static $connection;

  // fonction de connexion à la bdd
  // fonction connect, prend un parametre. On determine des variables par defaut de ce parametre (tableau), au
  // cas ou il ne les contiendrait pas.
  // puis, on crée un nouvel objet PDO dans la variable statique de la classe db qui contiendra les infos de la
  // variable en parametre, ou, null
  // si la connexion echoue, on lance une erreur PDOException
  static function connect($options) {
    try
    {
      $options += array('username' => null, 'password' => null, 'options' => null);
      self::$connection = new PDO($options['datasource'], $options['username'], $options['password'], $options['options']);
    }
    catch (PDOException $e)
    {
      die("database connection failed : " . $e->getMessage());
    }
  }

  // on passe en parametre une requete sql et on l'execute avec query
  static function query($sql) {
    return self::$connection->query($sql);
  }

  // on passe en parametre une ligne de resultat de requete, et la fonction retourne un objet avc les nom de ses
  // proprietes qui sont egales aux noms des colonnes de la ligne du result statement
  static function fetch($result_statement, $class = null) {
    if ($class) {
      $result_statement->setFetchMode(PDO::FETCH_CLASS, $class);
      return $result_statement->fetch(PDO::FETCH_CLASS);
    }
    return $result_statement->fetch(PDO::FETCH_OBJ);
  }

  // execute la requete sql passée en parametre, et retourne une ligne
  static function fetchRow($sql, $class = null) {
    $query = db::query($sql);
    if ($query) {
      return db::fetch($query, $class);
    }
    return array();
  }

  // execute la requete sql passée en parametre, et retourne une colonne
  static function fetchCol($sql) {
    return db::query($sql)->fetchAll(PDO::FETCH_COLUMN);
  }

  // retourne tous les resultats associés a la requete sql passée en parametre
  static function fetchAll($sql, $class = null) {
    $query = db::query($sql);
    if (!is_object($query)) {
      return array();
    }
    if ($class) {
      $query->setFetchMode(PDO::FETCH_CLASS, $class);
      return $query->fetchAll(PDO::FETCH_CLASS);
    }
    return $query->fetchAll(PDO::FETCH_OBJ);
  }

  static function fetchValue($sql) {
    return current(db::fetchRow($sql));
  }

  static function quote($value) {
    return self::$connection->quote($value);
  }
}

