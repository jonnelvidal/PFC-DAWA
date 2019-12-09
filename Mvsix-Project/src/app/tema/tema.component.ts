import { Component, OnInit } from '@angular/core';
import { Tema } from '../../entities/tema';
import { ApiService } from '../api.service';
@Component({
  selector: 'app-tema',
  templateUrl: './tema.component.html',
  styleUrls: ['./tema.component.css']
})
export class TemaComponent implements OnInit {
  temas: Tema[];
  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.readTemas().subscribe((temas: Tema[])=>{
      this.temas = temas;
      console.log(this.temas)
    });
  }

}
