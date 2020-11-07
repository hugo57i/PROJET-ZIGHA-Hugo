import { Component, OnInit } from '@angular/core';
import { UserService } from '../user.service';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  public login: string;
  public motDePasse: string;

  public wrongLogs: boolean = false;
  public alreadyConnected: boolean = false;

  constructor(public userService: UserService) { }

  ngOnInit() {
    if(localStorage.getItem('connected') !== null && localStorage.getItem('connected') === 'true') {
      this.alreadyConnected = true;
      this.login = localStorage.getItem('login');
    }
  }

  public checkValues(): boolean {
    if ( this.login && this.login !== '' && this.motDePasse
    && this.motDePasse !== '') {
      return false;
    }
    return true;
  }

  public onSubmit(): void {
    this.userService.login(this.login, this.motDePasse).subscribe(data => {
      console.log(data);
      this.wrongLogs = data.success === true ? false : true;
      if(data.success) {
        localStorage.setItem('connected', 'true');
        localStorage.setItem('login', this.login);
        this.alreadyConnected = true;
      }
    });
  }

  public onDisconnect(): void {
    localStorage.clear();
    this.alreadyConnected = false;
  }

}
