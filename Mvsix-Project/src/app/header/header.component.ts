import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';

import { isNullOrUndefined } from 'util';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  logeado: Boolean = false;
  constructor(private auth: AuthService) { }

  ngOnInit() {
    if(isNullOrUndefined(this.auth.getUsuario())){
      console.log("HOLA");
      this.logeado = false;
    }else{
      console.log("ADIOS");
      this.logeado = true;
    }
  }

}
