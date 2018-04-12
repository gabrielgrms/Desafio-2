SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `allotment`
--

CREATE TABLE `allotment` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `condom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnpj` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `company`
--

INSERT INTO `company` (`id`, `name`, `cnpj`) VALUES
(1, 'JohnnyEnterprises', '12321353453534'),
(2, 'Joana Empresarial', '30291839540830');

-- --------------------------------------------------------

--
-- Estrutura para tabela `condom`
--

CREATE TABLE `condom` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dweller`
--

CREATE TABLE `dweller` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `allotment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `allotment`
--
ALTER TABLE `allotment`
  ADD PRIMARY KEY (`id`,`condom_id`),
  ADD KEY `fk_Lote_condom1_idx` (`condom_id`);

--
-- Índices de tabela `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `condom`
--
ALTER TABLE `condom`
  ADD PRIMARY KEY (`id`,`company_id`),
  ADD KEY `fk_condom_company_idx` (`company_id`);

--
-- Índices de tabela `dweller`
--
ALTER TABLE `dweller`
  ADD PRIMARY KEY (`id`,`allotment_id`),
  ADD KEY `fk_dweller_allotment1_idx` (`allotment_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `allotment`
--
ALTER TABLE `allotment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `condom`
--
ALTER TABLE `condom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `dweller`
--
ALTER TABLE `dweller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `allotment`
--
ALTER TABLE `allotment`
  ADD CONSTRAINT `fk_Lote_condom1` FOREIGN KEY (`condom_id`) REFERENCES `condom` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `condom`
--
ALTER TABLE `condom`
  ADD CONSTRAINT `fk_condom_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `dweller`
--
ALTER TABLE `dweller`
  ADD CONSTRAINT `fk_dweller_allotment1` FOREIGN KEY (`allotment_id`) REFERENCES `allotment` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
