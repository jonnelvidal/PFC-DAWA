import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { DialogOverviewExampleDialog } from '../usuario.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(public dialog: MatDialog) { }

  openDialog(){
    this.dialog.open(DialogOverviewExampleDialog, {
      width: '50%',
      height: '50%'
    });
  }

  ngOnInit() {
    this.openDialog();
  }

}
