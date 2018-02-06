... .... ....
  /**
   * Ideja kako bih resio Suggested friends
   * Get the friends id for the given user id.
   *
   * @param type $userId
   * @return type
   */
  public function getFriends($userId) {
    $sql = 'SELECT * FROM `friend` WHERE ' .
            '(`user_id` = ' . $userId . ' OR `friend_id` = '. $userId .') ';

    $resultObj = $this->dbCon->query($sql);

    $friends = array();

    while($row = $resultObj->fetch_assoc()) {
      if ($row['user_id'] !== $userId) {
        $friends[] = $row['user_id'];
      }

      if ($row['friend_id'] !== $userId) {
        $friends[] = $row['friend_id'];
      }
    }

    return $friends;
  }

  /**
   *Uzmi objekat sa detaljima korisnika za izabrani id korisnika
   * @param $userId
   * @return array|null
   */
  public function getUser($userId) {
    $user = null;
    $sql = 'SELECT * FROM `user` WHERE `user_id` = ' . $userId;

    $resultObj = $this->dbCon->query($sql);

    if ($resultObj) {
      $user = $resultObj->fetch_assoc();
    }

    return $user;
  }

  /**
   * Prikazi listu suggested users za odbranog korisnika(user-a).
   */
  public function getFriendSuggestions() {
    $userId = $this->getUser->getUserId();
    $friends = $this->getFriends($userId);
    $suggestedFriends = [];

    foreach ($friends as $friendId) {
      # Friends friends list.
      $ff_list = $this->getFriends($friendId);

      foreach ($ff_list as $ffriendId) {
        # If the friendsFriend(ff) ako nije taj korisnik, niti nije njegov prijatelj, on moze biti predlozen
        if ($ffriendId != $userId && !in_array($ffriendId, $friends)) {

          # Kljuc oznacava predlozenog prijatelja (suggested Friend)
          $suggestedFriends[$ffriendId] = ['mutual_friends' => []];
          $ff_friends = $this->getFriends($ffriendId);

          foreach ($ff_friends as $ff_friendId) {
            if (in_array($ff_friendId, $friends)) {
              #Ako je on prijatelj trenutnog korisnika, onda je on zajednicki prijatelj (mutual friend)
              $suggestedFriends[$ffriendId]['mutual_friends'][] = $ff_friendId;
            }
          }

        }
      }

    }

    # Konverzija friend id-va u objekte korisnika(tj. predlozene prijatelje).
    $suggestedFriendObjs = array();
    if (!empty($suggestedFriends)) {
      foreach ($suggestedFriends as $suggestedFriend => $mutualFriends) {
        $suggestedFriendObj = new stdClass();
        $suggestedFriendObj->suggestedUser = $this->getUser($suggestedFriend);

        if (!empty($mutualFriends)) {
          $mutualFriendObjs = [];
          foreach ($mutualFriends['mutual_friends'] as $mutualFriend) {
            $mutualFriendObjs[] =  $this->getUser($mutualFriend);
          }
        }

        $suggestedFriendObj->mutualFriends = $mutualFriendObjs;
        $suggestedFriendObjs[] = $suggestedFriendObj;
      }
    }

    return $suggestedFriendObjs;
  }
... .. ...
