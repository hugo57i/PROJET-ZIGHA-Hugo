import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PanierRoutingModule } from './panier-routing.module';

import { PanierComponent } from '../../../panier/panier.component';


@NgModule({
  declarations: [
    PanierComponent
  ],
  imports: [
    CommonModule,
    PanierRoutingModule
  ],
  exports: [
    PanierComponent
  ]
})
export class PanierModule { }
