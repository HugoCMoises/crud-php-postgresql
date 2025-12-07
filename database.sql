CREATE TABLE public.produtos (
	id serial4 NOT NULL,
	nome varchar(100) NOT NULL,
	preco numeric(10, 2) NOT NULL,
	criado_em timestamp DEFAULT CURRENT_TIMESTAMP NULL,
	CONSTRAINT produtos_pkey PRIMARY KEY (id)
);