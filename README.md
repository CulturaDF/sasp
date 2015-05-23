SASP - Sistema de Seleção Pública
========================

É um plugin Wordpress desenvolvido tendo em vista as singularidades dos processos de fomento ao audiovisual nacional, realizados por meio de processos seletivos pela Secretaria do Audiovisual - MinC.

## Versões

1.0 - 2011


Desenvolvedores
----------------

[Marcelo Mesquita](http://marcelomesquita.com)

[Cleber Santos](http://culturadigital.br/membros/clebersantos/)

[Ricardo Evangelista](http://galdar.com.br/)

## Perfis de Acesso

O SASP conta com diversos perfis de acesso com diferentes níveis de privilégio conforme descrito:

#### Administrador
Pode incluir, editar e excluir Editais.
Consegue visualizar o andamento das inscrições, tendo acesso a todos os dados das propostas, independente do estado em que ela se encontra, podendo assim, auxiliar os proponentes durante todo o processo.
Também tem acesso ao perfil dos usuários, podendo restaurar suas senhas, quando necessário ou alterar seus privilégios.

#### Analista
Consegue visualizar o andamento das inscrições, tendo acesso a todos os dados das propostas, independente do estado em que ela se encontra, podendo assim, auxiliar os proponentes durante todo o processo. É ele também o responsável pela avaliação documental e alteração do estado das propostas.

####
 Consultor
Possui acesso aos dados relevantes para a avaliação de uma propostas. Pode habilitar ou inabilitar as propostas juntamente com sua avaliação textual ou, quando necessário, pontuação.
####
 Proponente
Pode incluir, editar e excluir seus dados pessoais.

Consegue incluir e editar as propostas para editais abertos e acompanhar todo o tramite de sua propostas. Também lhes é permitido entrar com recurso, quando for o caso.

## Gerenciamento de Editais
O cadastro dos editais só pode ser realizado por administradores ou analistas. Durante o cadastro eles devem informar, pelo menos: o nome do edital, as datas de abertura e encerramento, para que tipo de proponentes o edital é direcionado e a declaração de participação. Essas são as informações mínimas para disponibilização dos editais.

## Cadastro de Proponentes
Com a finalidade de manter a consistência dos dados dos proponentes, foi montado um modelo de dados único para todos os usuários com o CPF/CNPJ como campo primário, ou seja, pode existir apenas um usuário por CPF/CNPJ e os dados desse usuário são atualizados em todo o sistema sempre que ocorre uma modificação.

Para cada usuário criado, precisa existir obrigatóriamente um nome e e-mail associados ao campo primário do usuário.

## Cadastro de Propostas
O cadastro de propostas está dividido em etapas que variam de acordo com o edital. Algumas etapas são obrigatórias enquanto outras são opcionais com o intuito de atender a especificidades dos editais.

### Etapas Obrigatórias

#### Dados do Concorrente
É nessa etapa onde o proponente informa seus dados pessoais, dados de contato, dados geográficos e dados profissionais. Os campos CPF/CNPJ são apresentados apenas para conferência, não sendo permitido editá-los.

Caso o proponente já tenha participado de outros processos seletivos, seus dados são carregados no formulário automaticamente, sendo permitido ao proponente editá-los, dessa forma temos sempre informações atualizadas em nosso banco de dados.

Só é permitido continuar a inscrição da proposta após informar todos os campos obrigatórios.

#### Dados Gerais
Os dados do projeto e dados específicos do edital devem ser preenchidos nesse momento. Os campos ficam divididos em módulos e variam de acordo com o edital.

Até o momento só foram definidos módulos do audiovisual, cadastro de novos módulos só podem ser feitos através de programação, assim é possível manter o sistema conciso pois todos os campos são analisados, filtrados e comparados com campos já existentes.

#### Declaração
Antes do envio da proposta, para análise dos consultores e analistas, o usuário deve estar de acordo com os termos definidos para o edital. Ao enviar a proposta, todos os campos preenchidos nas etapas anteriores são novamente conferidos e caso haja algum campo fora de conformidade, o envio é cancelado e uma mensagem de erro é retornada ao proponente informando quais os campos precisam de sua atenção.

Caso não identifique erros, o sistema, finaliza a inscrição mas mantém todo o formulário à disposição do proponente para futuras conferências e acompanhamento, não permitindo edições posteriores.

As propostas poderão ser impressas ou salvas em pdf, após a finalização do cadastro, tanto pelo proponente quanto pelos analistas.

### Etapas Opcionais

#### Currículo
Nos casos onde é necessária a avaliação dos profissionais que serão envolvidos no projeto, o módulo de cadastro de currículo auxilia na criação de um portfólio para os profissionais.

Primeiramente o proponente deve informar o CPF do profissional que participará do projeto, caso esse profissional já exista em nosso banco de profissionais o sistema carrega automaticamente o portfólio desse profissional. Se o CPF informado não existir, proponente deverá informar seus dados básicos e as obras realizadas pelo profissional.

#### Orçamento
O orçamento é dividido por fases de produção e áreas. Os proponentes podem adicionar quantos itens desejarem em cada área, para cada item adicionado é obrigatório informar: a quantidade de itens, a unidade e o valor unitário; o cálculo do valor total do item e valor toda da área são feitos pelo sistema.


## Avaliação de Propostas
As proposta são avaliadas por dois tipos de perfil no sistema, Analista e Consultor, conforme segue abaixo.

#### Analista: 
Pode avaliar os documentos da proposta e alterar o estado em todas as fases, porém, quando a inscrição está com status inicial (inscrito) o analista é obrigado a realizar à análise de toda proposta, podendo alterar o status somente na última aba do projeto.

#### Consultor:
Trata-se dos membros da comissão de seleção, este perfil realiza as avaliações das propostas, pontuando de acordo com os critérios de avaliação e exigências de cada edital.


## Interposição de recursos

A opção de recurso, pode ser realizada em qualquer fase no sistema, o período e o status para recurso são definidos pelo perfil de administrador.


## Histórico das Propostas

Todas as alterações realizadas na proposta são registradas pelo sistema, os concorrentes podem visualizar o histórico da sua proposta, desse modo, o responsável pelo projeto pode visualizar se houve alguma alteração na sua inscrição e nos casos de indeferimento pode visualizar o motivo diretamente no sistema.






