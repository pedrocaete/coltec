#include <stdio.h>
#include <stdlib.h>
#include <locale.h>
#include <math.h>
int menu(void);
void calculo_juros_reais(void);
void conversor_moeda(void);
void reserva_emergencia(void);
void juros_compostos(void);
void poupanca_faculdade(void);
void imposto_renda(void);
void juntar_dinheiro(void);
void simulador_emprestimo(void);
void independencia_financeira(void);
int main()
{
	int opc;
	setlocale(LC_ALL, "Portuguese");
	do{
		opc=menu();
		switch(opc){
	case 1:
		calculo_juros_reais();
		break;
	case 2:
		conversor_moeda();
		break;
	case 3:
		reserva_emergencia();
		break;
	case 4:
		juros_compostos();
		break;
	case 5:
		poupanca_faculdade();
		break;
	case 6:
		juntar_dinheiro();
		break;
	case 7:
		simulador_emprestimo();
		break;
	case 8:
		imposto_renda();
		break;
	case 9:
		independencia_financeira();
		break;}
	}while(opc!=0);
	system("pause");
	return 0;

}

int menu(void){
	int opcaodesejada;
	printf("**************************************************\n");
	printf("MYMONEY - DIGITE A OPÇÃO DESEJADA\n");
	printf("**************************************************\n");
	printf("(1) Cálculo dos juros reais\n");
	printf("(2) Conversão de moedas\n");
	printf("(3) Cálculo da reserva de emergência\n");
	printf("(4) Juros compostos com depósito mensal\n");
	printf("(5) Poupança para a faculdade\n");
	printf("(6) Plano para juntar dinheiro\n");
	printf("(7) Simulador de empréstimo\n");
	printf("(8) Cálculo do imposto de renda\n");
	printf("(9) Independência financeira\n");
	printf("(0) Sair\n");
	scanf("%i",&opcaodesejada);
	if(opcaodesejada>9||opcaodesejada<0)
	printf("Opção Inválida\n");
	return(opcaodesejada);
}

void calculo_juros_reais(void){
	float inflacao1, jurosnominal1, jurosreais1;
	printf("CÁLCULO DOS JUROS REAIS\n");
	printf("Insira a taxa de juros nominal a.a. em %%:\n");
	scanf("%f",&jurosnominal1);
	printf("Insira a taxa de inflação a.a em %%:\n");
	scanf("%f",&inflacao1);
	jurosreais1=(((1+(jurosnominal1/100))/(1+(inflacao1/100)))-1)*100;
	printf("Taxa de juros reais: %.2f \n",jurosreais1);
}

void conversor_moeda(void){
	int opcaodesejada2;
	float valormoeda2,valorconvert2;
	printf("CONVERSÃO DE MOEDAS\n");
	printf("(1) Dólar (USD) -> Real (BRL)\n(2) Real (BRL) -> Dólar (USD)\n(3) Euro (EUR) -> Real (BRL)\n(4) Real (BRL) -> Euro (EUR)\n(5) Libra Esterlina (GBP) -> Real (BRL)\n6) Real (BRL) -> Libra Esterlina (GBP)\n");
	scanf("%i",&opcaodesejada2);
	switch(opcaodesejada2){
		case 1:
			printf("Digite o valor em dólar (USD) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em reais (BRL):");
			valorconvert2=valormoeda2*5.12;
			break;
		case 2:
			printf("Digite o valor em real (BRL) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em dólares (USD):");
			valorconvert2=valormoeda2/5.12;
			break;
		case 3:
			printf("Digite o valor em euro (EUR) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em reais (BRL):");
			valorconvert2=valormoeda2*5.4;
			break;
		case 4:
			printf("Digite o valor em real (BRL) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em euros (EUR):");
			valorconvert2=valormoeda2/5.4;
			break;
		case 5:
			printf("Digite o valor em libra esterlina (GBP) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em reais (BRL):");
			valorconvert2=valormoeda2*6.29;
			break;
		case 6:
			printf("Digite o valor em real (BRL) a ser convertido:\n");
			scanf("%lf",&valormoeda2);
			printf("Valor em libras esterlinas (GBP):");
			valorconvert2=valormoeda2/6.29;
			break;
		default:
			printf("Valor Inválido\n");
		}
	printf("%.2lf\n",valorconvert2);
}

void reserva_emergencia(void){
	float sal3,desp3,poup3,temppoup3,reservaem3;
	printf("CÁLCULO DA RESERVA DE EMERGÊNCIA");
	printf("Digite seu salário mensal(R$):\n");
	scanf("%f",&sal3);
	printf("Digite suas despesas mensais:(R$)\n");
	scanf("%f",&desp3);
	if(sal3<0||desp3<0)
		printf("Erro\n");
	else{
	poup3=sal3-desp3;
	reservaem3=desp3*6;
	temppoup3=reservaem3/poup3;
	printf("Sua reserva de emergência deve ser R$%.2f\nSerão necessários %.1f meses poupando R$%.2f para atingir esse valor\n",reservaem3,temppoup3,poup3);
		}
}

void juros_compostos(void){
	int nmeses4, cont4;
	float taxa4,dep4,invest4,vmes4[300],vf;
	printf("JUROS COMPOSTOS COM DEPOSITO MENSAL\nDigite o valor do investimento inicial em R$:");
	scanf("%f",&invest4);
	printf("Digite o valor dos depósitos mensais em R$:");
	scanf("%f",&dep4);
	printf("Digite a taxa de juros mensal(%%):");
	scanf("%f",&taxa4);
	printf("Digite o período de tempo em meses:");
	scanf("%i",&nmeses4);
	taxa4=taxa4/100;
	vmes4[0]=invest4;
	for(cont4=1;cont4<nmeses4;cont4++)
		vmes4[cont4]=vmes4[cont4-1]*(1+taxa4)+dep4;
	if(cont4=nmeses4-1)
			vf=vmes4[cont4];
	printf("O valor final do investimento será R$ %.2f\n", vf);
}

void poupanca_faculdade(void){
	float mensalidade2, anoscurso2, idade2, juros2, valorcurso2, poupanca2, mesesfacul2;
	printf("POUPANÇA PARA A FACULDADE\n");
	printf("Insira o valor da mensalidade (R$):\n");
	scanf("%f",&mensalidade2);
	printf("Insira o tempo de curso (anos):\n");
	scanf("%f",&anoscurso2);
	printf("Insira a idade atual do filho:\n");
	scanf("%f",&idade2);
	printf("Insira a taxa de juros mensal dos investimentos (%%):\n");
	scanf("%f",&juros2);
	valorcurso2= anoscurso2*mensalidade2*12;
	mesesfacul2=(18-idade2)*12;
	poupanca2= (valorcurso2*(juros2/100))/(pow((1+(juros2/100)), mesesfacul2)-1);
	if(mensalidade2<=0 || anoscurso2<=0 || idade2<=0 || juros2<=0)
		printf("Erro, valor inválido.\n");
	else{
		printf("O valor do curso após %.1f anos é R$%.2f\n",anoscurso2, valorcurso2);
		if(idade2>=18){
			printf("Você deve poupar R$%.2f por mês\n", mensalidade2);}
			else{
			printf("Você deve poupar R$%.2f por mês\n",poupanca2);}
		}
}

void imposto_renda(void){
	int opcaodesejada8,dias8;
	float pctiof8,pctir8,pctimpt8;
	double lucrol8,lucrob8,iof8,ir8,valorinvest8,investresgatado8,impt8;
	printf("CALCULO IMPOSTO DE RENDA\n(1)Ações\n(2)Renda Fixa\n");
	scanf("%i",&opcaodesejada8);
	printf("Insira valor investido (R$):\n");
	scanf("%lf",&valorinvest8);
	printf("Insira valor resgatado (R$):\n");
	scanf("%lf",&investresgatado8);
	printf("Insira tempo de investimento (dias):\n");
	scanf("%i",&dias8);
	lucrob8=investresgatado8-valorinvest8;
	switch(opcaodesejada8){
		case 1:
			if(dias8>0&&investresgatado8<20000){
			ir8=0;
			pctir8=0;}
			else if(dias8==0){
			ir8=0.2*lucrob8;
			pctir8=0.2;}
			else if(dias8>0){
			ir8=0.15*lucrob8;
			pctir8=0.15;}
			break;
		case 2:
			iof8=0;
			if(dias8<30&&dias8>0){
			iof8=(0.9933-dias8*0.0333)*lucrob8;
			pctiof8=0.9933-dias8*0.0333;}
			if(dias8==0){
			iof8=0.96*lucrob8;
			pctiof8=0.96;}
			if(dias8<180){
			ir8=(lucrob8-iof8)*0.225;
			pctir8=0.225;}
			else if(dias8>180&&dias8<360){
			ir8=lucrob8*0.2;
			pctir8=0.2;}
			else if(dias8>360&&dias8<720){
			ir8=lucrob8*0.175;
			pctir8=0.175;}
			else if(dias8>720){
			ir8=lucrob8*0.15;
			pctir8=0.15;}
			break;
		default:
			printf("Valor Inválido\n");
		}
	lucrol8=lucrob8-iof8-ir8;
	pctimpt8=(pctiof8+((1-pctiof8)*pctir8))*100;
	impt8=ir8+iof8;
	printf("Lucro Bruto: R$%.2lf\nLucro Líquido: R$%.2lf\nGasto com IOF e IR(R$): %.2lf\nGasto com IOF e IR(%%): %.2lf%%\nIOF Retido (apenas para renda fixa): R$%.2lf\nImposto de Renda Retido: R$%.2lf\n",lucrob8,lucrol8,impt8,pctimpt8,iof8,ir8);
}

void juntar_dinheiro(void){
	float renda,gb,estv,juros,obj, poupar,invest;
	int meses;
	printf("PLANO PARA JUNTAR DINHEIRO\n");
	printf("Digite o valor da renda atual em R$: ");
	scanf("%f",&renda);
	printf("Digite o percentual de gastos básicos: ");
	scanf("%f",&gb);
	printf("Digite o percentual de gastos com estilo de vida: ");
	scanf("%f",&estv);
	printf("Digite o objetivo financeiro em R$: ");
	scanf("%f",&obj);
	printf("Digite a taxa de juros mensal dos investimentos(%%): ");
	scanf("%f",&juros);
	juros/=100;
	gb=(gb/100)*renda;
	estv=(estv/100)*renda;
	poupar=renda-gb-estv;
	printf("Total em gastos básicos: R$ %.2f\nTotal em gastos com estilo de vida: R$ %.2f\nTotal a ser poupado: R$ %.2f\n",gb,estv,poupar);
	for(meses=0;invest<obj;meses++)
		invest=invest*(1+juros)+poupar;
	printf("Tempo para atingir o objetivo financeiro: %i meses\n",meses);
}
void simulador_emprestimo(void){
		float vt,jp,dr,j,a,tj=0,tf;
    int p;
    printf("SIMULADOR DE EMPRESTIMO\n");
printf("Digite o valor total a ser financiado em R$: ");
scanf("%f",&vt);
fflush(stdin);
printf("Digite o numero de prestações mensais: ");
scanf("%i",&p);
printf("Digite a taxa de juros mensal do financiamento (%%): ");
scanf("%f",&j);
fflush(stdin);
a=vt/p;
j/=100;
dr=vt;
float vp[p-1];
for(int x=0;x<p;x++){
jp=dr*j;
tj+=jp;
dr-=a;
vp[x]=jp+a;
}
printf("Total pago em juros: R$ %.2f\nTotal do financiamento: R$ %.2f\n",tj,tj+vt);
printf("Valor da 1 prestacao: R$ %.2f\n",vp[0]);
for(int x=10;x<=p;x+=10){
printf("Valor da %d prestacao: R$ %.2f\n",x,vp[x-1]);
}
if(p%10)
printf("Valor da %d prestacao: R$ %.2f\n",p,vp[p-1]);
}

void independencia_financeira(void){
	float fv,n,pmt, tabela[16][8], i=0.0015;
	printf("INDEPENDENCIA FINANCEIRA\n");
	printf("Digite o valor da meta para indepencia financeira em R$: ");
	scanf("%f",&fv);
	printf("TAXA\t3\t5\t7\t10\t15\t20\t25\t30\t35\t40\n");
	for(int x=0;x<17;x++){
		i+=0.0005;
		printf("%.2f%%\t",i*100);
		for(int y=0;y<10;y++){
			switch(y){
			case 0:
				n=36;
				break;
			case 1:
				n=60;
				break;
			case 2:
				n=84;
				break;
			case 3:
				n=120;
				break;
			}
			if(y>3)
				n+=60;
			pmt=fv/((1+i/10)*(pow((1+i),n)-1)/i);
			printf("%-7.2f\t",pmt);
		}
		printf("\n");
	}
}