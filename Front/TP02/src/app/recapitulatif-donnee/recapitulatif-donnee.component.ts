import { Component, OnInit, Input } from '@angular/core';
import { User } from '../user';

@Component({
  selector: 'app-recapitulatif-donnee',
  templateUrl: './recapitulatif-donnee.component.html',
  styleUrls: ['./recapitulatif-donnee.component.css']
})
export class RecapitulatifDonneeComponent implements OnInit {

  @Input() user: User;
  constructor() { }

  ngOnInit() {
  }

}
