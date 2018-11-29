<? class user {
    public function create($data) {
        $user = R::dispense( 'users' );
        $user->login = $data['login'];
    }
}